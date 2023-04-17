@include('header')
@include('sidebar')  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1>Countries</h1>
          </div>
          <div class="col-sm-2">
          <button type="button" class="btn btn-outline-primary btn-block addCountry"><i class="fa fa-plus"></i> Add Country</button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Countries List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped myTable">
                  <thead>
                  <tr>
                    <th>Sr.#</th>
                    <th>Country</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>  
                  </tbody> 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div> 

<!-- country modal -->
  <div class="modal fade" id="countryModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form name="country-form" id="country-form">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Country</label>
                    <input type="text" class="form-control" id="country" name="country" placeholder="Enter country">
                  </div>
                  <input type="hidden" name="country" id="country_id">
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary addEditCountry">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<!-- country modal end -->

<!-- country modal -->
<div class="modal fade" id="deleteCountryModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <strong>Are you sure to delete this record?</strong>
           <input type="hidden" name="coountry_id" id="coountry_id">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary deleteCountryAction">Delete</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<!-- country modal end -->


@include('footer')
<script>

var devicesDt;
function getData()
{
if (typeof (devicesDt) != 'undefined') {
 devicesDt.clear();
 devicesDt.destroy();
 }
 devicesDt = $(".myTable").DataTable({
 paging: true,
            searching: true,
            responsive: true,
            order: [],
        "tabIndex": -1,
             "ajax": {
                "url": "/countryTableList",
                "type": "POST",
                "data": {'uc' : 1 , "_token": "{{ csrf_token() }}"},
                failure: function (response) {
                }, error: function (response) {
 }

 },

 "initComplete": function (settings, json) {
            },
            "columns": [
    {
        "data": "country_id",
        render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
        }
    },
    { "data": "country" },
    {
        "render": function (data, type, full, meta){
            return "<a class='btn btn-primary btn-sm editCountry' data-country_id='"+full.country_id+"' data-country='"+full.country+"'><i class='fas fa-edit'></i> Edit</a> <a class='btn btn-danger btn-sm deleteCountry'><i class='fas fa-trash'></i> Delete</a>";
        }
    }, 
],
   "dom": '<f<t>lip>',

dom: 'B<f<t>lip>',
   buttons: [
                       
   ],
language: {
            search: "_INPUT_",
            searchPlaceholder: "Search"
        }, 
});
}
$(document).ready(function(){
 getData(); 
  });
  $(document).on('click','.addCountry',function(){
		$("#country_id").val("");
		$(".modal-title").text("Add Country");
		$('#countryModal').modal('show');
	});
    $(document).on('click','.editCountry',function(){
		var country_id=$(this).attr("data-country_id");
        var country=$(this).attr("data-country");
        $("#country_id").val(country_id);
        $("#country").val(country);
		$(".modal-title").text("Edit Country");
		$('#countryModal').modal('show');
	});
    $(document).on('click','.deleteCountry',function(){
		var country_id=$(this).attr("data-country_id");
        $("#country_id").val(country_id);
		$(".modal-title").text("Delete Country");
		$('#deleteCountryModal').modal('show');
	});
    $(document).on('click','.addEditCountry',function(){
     var country_id = $('#country_id').val();
     var country = $('#country').val();
     var token = $('#csrf').val();
     var type = 1;
     var form_data = new FormData();
    form_data.append("country_id", country_id);
    form_data.append("country", country);
    form_data.append("_token", token);
    form_data.append("type", type);
     $.ajax({
             url: "/addEditCountry",
             type: "POST",
             data: form_data,
             cache: false,
             contentType: false,
             processData: false,
             success: function(data){
                 var obj = JSON.parse(data);
                 if(obj.sucesss==200)
                 {
                    $('#countryModal').modal('hide');
                    $('#country-form').trigger("reset");
                    alert(obj.message);
                    getData();				
                 }
                 else
                 {
                    alert(obj.message);
                 } 
             }
         });
        });

    $(document).on('click','.addEditCountry',function(){deleteCountryAction
     var country_id = $('#country_id').val();
     var country = $('#country').val();
     var token = $('#csrf').val();
     var type = 1;
     var form_data = new FormData();
    form_data.append("country_id", country_id);
    form_data.append("country", country);
    form_data.append("_token", token);
    form_data.append("type", type);
     $.ajax({
             url: "/addEditCountry",
             type: "POST",
             data: form_data,
             cache: false,
             contentType: false,
             processData: false,
             success: function(data){
                 var obj = JSON.parse(data);
                 if(obj.sucesss==200)
                 {
                    $('#countryModal').modal('hide');
                    $('#country-form').trigger("reset");
                    alert(obj.message);
                    getData();				
                 }
                 else
                 {
                    alert(obj.message);
                 } 
             }
         });
        });

</script>

@include('header')
@include('sidebar')  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1>Languages</h1>
          </div>
          <div class="col-sm-2">
          <button type="button" class="btn btn-outline-primary btn-block addLanguage"><i class="fa fa-plus"></i> Add Language</button>
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
                <h3 class="card-title">Languages List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped myTable">
                  <thead>
                  <tr>
                    <th>Sr.#</th>
                    <th>Language</th>
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
  <div class="modal fade" id="languageModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form name="language-form" id="language-form">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Language*</label>
                    <input type="text" class="form-control" id="language" name="language" placeholder="Enter language">
                  </div>
                  <input type="hidden" name="language_id" id="language_id">
              
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btnBlock">Save changes</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<!-- country modal end -->

<!-- country modal -->
<div class="modal fade" id="deleteLanguageModal">
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
           <input type="hidden" name="language_id" id="language_id">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary deleteLanguageAction">Delete</button>
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
                "url": "/languageTableList",
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
        "data": "language_id",
        render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
        }
    },
    { "data": "language" },
    {
        "render": function (data, type, full, meta){
            return "<a class='btn btn-primary btn-sm editLanguage' data-language_id='"+full.language_id+"' data-language='"+full.language+"'><i class='fas fa-edit'></i> Edit</a> <a class='btn btn-danger btn-sm deleteLanguage' data-language_id='"+full.language_id+"'><i class='fas fa-trash'></i> Delete</a>";
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
  $(document).on('click','.addLanguage',function(){
		$("#language_id").val("");
		$(".modal-title").text("Add Language");
		$('#languageModal').modal('show');
	});
    $(document).on('click','.editLanguage',function(){
		var language_id=$(this).attr("data-language_id");
        var language=$(this).attr("data-language");
        $("#language_id").val(language_id);
        $("#language").val(language);
		$(".modal-title").text("Edit Language");
		$('#languageModal').modal('show');
	});
    $(document).on('click','.deleteLanguage',function(){
		var language_id=$(this).attr("data-language_id");
        $("#language_id").val(language_id);
		$(".modal-title").text("Delete Language");
		$('#deleteLanguageModal').modal('show');
	});
 $(function() {
 $("form[name='language-form']").validate({
    rules: {
        language: "required",
      },
    messages: {
        language: "<span style='color:red'>Please enter language</span>"
    },
    submitHandler: function(form) {
     var language_id = $('#language_id').val();
     var language = $('#language').val();
     var token = $('#csrf').val();
     var type = 1;
     var form_data = new FormData();
    form_data.append("language_id", language_id);
    form_data.append("language", language);
    form_data.append("_token", token);
    form_data.append("type", type);
    $('.btnBlock').prop('disabled', true);
     $.ajax({
             url: "/addEditLanguage",
             type: "POST",
             data: form_data,
             cache: false,
             contentType: false,
             processData: false,
             success: function(data){
                 var obj = JSON.parse(data);
                 if(obj.sucesss==200)
                 {
                    $('#languageModal').modal('hide');
                    $('#language-form').trigger("reset");
                    toastr.success(obj.message, 'Success',{timeOut: 5000});
                    $('.btnBlock').prop('disabled', false);
                    getData();				
                 }
                 else
                 {
                    toastr.success(obj.message, 'Error',{timeOut: 5000});
                 } 
             }
         });
        }
    });
});

    $(document).on('click','.deleteLanguageAction',function(){
     var language_id = $('#language_id').val();
     var token = $('#csrf').val();
     var type = 1;
     var form_data = new FormData();
    form_data.append("language_id", language_id);
    form_data.append("_token", token);
    form_data.append("type", type);
     $.ajax({
             url: "/deleteLanguageAction",
             type: "POST",
             data: form_data,
             cache: false,
             contentType: false,
             processData: false,
             success: function(data){
                 var obj = JSON.parse(data);
                 if(obj.sucesss==200)
                 {
                    $('#deleteLanguageModal').modal('hide');
                    toastr.success(obj.message, 'Success',{timeOut: 5000});
                    getData();				
                 }
                 else
                 {
                    toastr.success(obj.message, 'Error',{timeOut: 5000});
                 } 
             }
         });
        });
</script>

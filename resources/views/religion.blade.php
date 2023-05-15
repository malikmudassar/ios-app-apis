@include('header')
@include('sidebar')  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1>Religions</h1>
          </div>
          <div class="col-sm-2">
          <button type="button" class="btn btn-outline-primary btn-block addReligion"><i class="fa fa-plus"></i> Add Religion</button>
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
                <h3 class="card-title">Religions List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped myTable">
                  <thead>
                  <tr>
                    <th>Sr.#</th>
                    <th>Religion</th>
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
  <div class="modal fade" id="religionModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form name="religion-form" id="religion-form">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Religion*</label>
                    <input type="text" class="form-control" id="religion" name="religion" placeholder="Enter religion">
                  </div>
                  <input type="hidden" name="religion_id" id="religion_id">
              
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

              <button type="submit" class="btn btn-primary btnBlock">
              <span class="btn-text">Save changes</span>
              <span class="spinner-border spinner-border-sm d-none spinner-rotation" role="status" aria-hidden="true"></span>
              </button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<!-- country modal end -->

<!-- country modal -->
<div class="modal fade" id="deleteReligionModal">
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
           <input type="hidden" name="religion_id" id="religion_id">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary btnBlock deleteReligionAction">
              <span class="btn-text">Delete</span>
              <span class="spinner-border spinner-border-sm d-none spinner-rotation" role="status" aria-hidden="true"></span>
              </button>
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
  columnDefs: [{  //dataTable warning
    "defaultContent": "-",
    "targets": "_all"
  }],
 paging: true,
            searching: true,
            responsive: true,
            order: [],
        "tabIndex": -1,
             "ajax": {
                "url": "{{ route('religionTableList') }}",
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
        "data": "religion_id",
        render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
        }
    },
    { "data": "religion" },
    {
        "render": function (data, type, full, meta){
            return "<a href='#' class='editReligion' data-religion_id='"+full.religion_id+"' data-religion='"+full.religion+"'><i class='fas fa-edit text-primary' data-toggle='tooltip' data-placement='top' title='Edit'></i></a> <a href='#' class='deleteReligion' data-religion_id='"+full.religion_id+"'><i class='fas fa-trash text-danger' data-toggle='tooltip' data-placement='top' title='Delete'></i></a>";
        }
    }, 
],
   "dom": '<f<t>lip>',

dom: 'B<f<t>lip>',
   buttons: [
                       
   ],
language: {
            search: "_INPUT_",
            searchPlaceholder: "Search",
            "loadingRecords": "<span class='spinner-border spinner-border-lg text-primary' role='status' aria-hidden='true'></span>"
        }, 
});
}
$(document).ready(function(){
 getData(); 
  });
  $(document).on('click','.addReligion',function(){
		$("#religion_id").val("");
		$(".modal-title").text("Add Religion");
		$('#religionModal').modal('show');
	});
    $(document).on('click','.editReligion',function(){
		var religion_id=$(this).attr("data-religion_id");
        var religion=$(this).attr("data-religion");
        $("#religion_id").val(religion_id);
        $("#religion").val(religion);
		$(".modal-title").text("Edit Religion");
		$('#religionModal').modal('show');
	});
    $(document).on('click','.deleteReligion',function(){
		var religion_id=$(this).attr("data-religion_id");
        $("#religion_id").val(religion_id);
		$(".modal-title").text("Delete Religion");
		$('#deleteReligionModal').modal('show');
	});
 $(function() {
 $("form[name='religion-form']").validate({
    rules: {
        religion: "required",
      },
    messages: {
        religion: "<span style='color:red'>Please enter religion</span>"
    },
    submitHandler: function(form) {
     var religion_id = $('#religion_id').val();
     var religion = $('#religion').val();
     var token = $('#csrf').val();
     var type = 1;
     var form_data = new FormData();
    form_data.append("religion_id", religion_id);
    form_data.append("religion", religion);
    form_data.append("_token", token);
    form_data.append("type", type);
    $('.btnBlock').prop('disabled', true);
    $('.spinner-rotation').removeClass('d-none');
     $.ajax({
             url: "{{ route('addEditReligion') }}",
             type: "POST",
             data: form_data,
             cache: false,
             contentType: false,
             processData: false,
             success: function(data){
                 var obj = JSON.parse(data);
                 if(obj.sucesss==200)
                 {
                    $('#religionModal').modal('hide');
                    $('#religion-form').trigger("reset");
                    toastr.success(obj.message, 'Success',{timeOut: 5000});
                    $('.btnBlock').prop('disabled', false);
                    getData();				
                 }
                 else
                 {
                    toastr.success(obj.message, 'Error',{timeOut: 5000});
                 } 
                   $('.btnBlock').prop('disabled', false);
                   $('.spinner-rotation').addClass('d-none');
             }
         });
        }
    });
});

    $(document).on('click','.deleteReligionAction',function(){
     var religion_id = $('#religion_id').val();
     var token = $('#csrf').val();
     var type = 1;
     var form_data = new FormData();
    form_data.append("religion_id", religion_id);
    form_data.append("_token", token);
    form_data.append("type", type);
    $('.spinner-rotation').removeClass('d-none');
    $('.btnBlock').prop('disabled', true);
     $.ajax({
             url: "{{ route('deleteReligionAction') }}",
             type: "POST",
             data: form_data,
             cache: false,
             contentType: false,
             processData: false,
             success: function(data){
                 var obj = JSON.parse(data);
                 if(obj.sucesss==200)
                 {
                    $('#deleteReligionModal').modal('hide');
                    toastr.success(obj.message, 'Success',{timeOut: 5000});
                    getData();				
                 }
                 else
                 {
                    toastr.success(obj.message, 'Error',{timeOut: 5000});
                 } 
                  $('.spinner-rotation').addClass('d-none');
                  $('.btnBlock').prop('disabled', false);
             }
         });
        });
</script>

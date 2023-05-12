@include('header')
@include('sidebar')  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1>Users</h1>
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
                <h3 class="card-title">Users List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped myTable">
                  <thead>
                  <tr>
                    <th>Sr.#</th>
                    <th>Profile</th>
                    <th>Provider</th>
                    <th>Age</th>
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
  <div class="modal fade" id="userModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form name="user-form" id="user-form">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Subsription Package*</label>
                    <select class="form-control" id="subsc_package" name="subsc_package">
                        <option value="Free">Free</option>
                        <option value="Paid">Paid</option>
                    </select>
                  </div>
                  <input type="hidden" name="id" id="id">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btnBlock editUserAction">
              <span class="btn-text">Save changes</span>
              <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
              </button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<!-- country modal end -->

@include('footer')
<script>
var base_url = '<?= url('/'); ?>';
var devicesDt;
function getData()
{
if (typeof (devicesDt) != 'undefined') {
 devicesDt.clear();
 devicesDt.destroy();
 }
 devicesDt = $(".myTable").DataTable({
  columnDefs: [{  //dataTable
    "defaultContent": "-",
    "targets": "_all"
  }],
 paging: true,
            searching: true,
            responsive: true,
            order: [],
        "tabIndex": -1,
             "ajax": {
                "url": "{{ route('usersTableList') }}",
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
        "data": "id",
        render: function (data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
        }
    },
    {
        "render": function(data, type, full, meta) {
          var image = full.profile_path !== null ? full.profile_path : ''+base_url+'/apiAssets/userProfiles/avatar.jpeg';
          return "<div class='image'><img src='" + image + "' class='img-circle elevation-2' height='40' width='40'><span class='ml-3'>"+full.fname+"</span></div>";
        }
      },
    { "data": "provider" },
    { "data": "age" },
    {
        "render": function (data, type, full, meta){
            return "<a href='#' class='editUser' data-id='"+full.id+"' data-subsc_package='"+full.subsc_package+"'><i class='fas fa-edit text-primary' data-toggle='tooltip' data-placement='top' title='Edit'></i></a> ";
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
            //"loadingRecords": "<span class='spinner-border spinner-border-lg text-primary' role='status' aria-hidden='true'></span>"
        }, 
});
}
$(document).ready(function(){
 getData(); 
  });
    $(document).on('click','.editUser',function(){
		var id=$(this).attr("data-id");
        var subsc_package=$(this).attr("data-subsc_package");
        $("#id").val(id);
        $("#subsc_package").val(subsc_package);
		$(".modal-title").text("Edit Subscription Package");
		$('#userModal').modal('show');
	});
    
 
    $(document).on('click','.editUserAction',function(){
     var id = $('#id').val();
     var subsc_package = $('#subsc_package').val();
     var token = $('#csrf').val();
     var type = 1;
     var form_data = new FormData();
    form_data.append("id", id);
    form_data.append("subsc_package", subsc_package);
    form_data.append("_token", token);
    form_data.append("type", type);
    $('.btnBlock').prop('disabled', true);
    $('.spinner-border').removeClass('d-none');
     $.ajax({
             url: "{{ route('editUser') }}",
             type: "POST",
             data: form_data,
             cache: false,
             contentType: false,
             processData: false,
             success: function(data){
                 var obj = JSON.parse(data);
                 if(obj.sucesss==200)
                 {
                    $('#userModal').modal('hide');
                    $('#user-form').trigger("reset");
                    toastr.success(obj.message, 'Success',{timeOut: 5000});
                    getData();			
                 }
                 else
                 {
                    toastr.success(obj.message, 'Error',{timeOut: 5000});
                 } 
                $('.btnBlock').prop('disabled', false);
                $('.spinner-border').addClass('d-none');
             }
         });
        
    });

   
</script>

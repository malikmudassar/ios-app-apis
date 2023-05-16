@include('header')
@include('sidebar')  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1>User Verification</h1>
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
                    <th>Docs</th>
                    <th>Name</th>
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
                "url": "{{ route('usersVerificationTableList') }}",
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
          return "<div class='image'><img src='" +full.image+ "' class='img-circle elevation-2' height='40' width='40'></div>";
        }
      },
    { "data": "fname" },
    {
        "render": function (data, type, full, meta){
            var verified_at = full.verified_at ? 'checked' : '';
            return " <div class='custom-control custom-switch'><b style='margin-right: 40px;'>Unverified</b> <input type='checkbox' class='custom-control-input isverified' id='customSwitch1' data-user_id='"+full.user_id+"' "+verified_at+"><label class='custom-control-label mr-2' for='customSwitch1'>Verified</label></div>";
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

  $(document).ready(function() {
  $(document).on('click', '.isverified', function() {
    var isChecked = $(this).prop('checked');
    var user_id = $(this).data('user_id');
    if (isChecked) 
    {
       var status = 'true';
    } 
    else 
    {
        var status = 'false';
    }
    var token = $('#csrf').val();
    var type = 1;
    var form_data = new FormData();
    form_data.append("user_id", user_id);
    form_data.append("status", status);
    form_data.append("_token", token);
    form_data.append("type", type);
     $.ajax({
             url: "{{ route('isverified') }}",
             type: "POST",
             data: form_data,
             cache: false,
             contentType: false,
             processData: false,
             success: function(data){
                 var obj = JSON.parse(data);
                 if(obj.sucesss==200)
                 {
                    
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
});

</script>

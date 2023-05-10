@include('header')
@include('sidebar')  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1>Categories</h1>
          </div>
          <div class="col-sm-2">
          <button type="button" class="btn btn-outline-primary btn-block addCategory"><i class="fa fa-plus"></i> Add Category</button>
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
                <h3 class="card-title">Categories List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped myTable">
                  <thead>
                  <tr>
                    <th>Sr.#</th>
                    <th>Category</th>
                    <th>Page</th>
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
  <div class="modal fade" id="categoryModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form name="category-form" id="category-form">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Country*</label>
                    <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter category">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Page*</label>
                    <input type="number" class="form-control" id="page" name="page" placeholder="Enter page no">
                  </div>

                  <input type="hidden" name="id" id="id">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btnBlock">
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

<!-- country modal -->
<div class="modal fade" id="deleteCategoryModal">
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
           <input type="hidden" name="id" id="id">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary btnBlock deleteCategoryAction">
              <span class="btn-text">Delete</span>
              <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
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
                "url": "/categoryTableList",
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
    { "data": "category_name" },
    { "data": "page" },
    {
        "render": function (data, type, full, meta){
            return "<a class='btn btn-primary btn-sm editCategory' data-id='"+full.id+"' data-category_name='"+full.category_name+"' data-page='"+full.page+"'><i class='fas fa-edit'></i> Edit</a> <a class='btn btn-danger btn-sm deleteCategory' data-id='"+full.id+"'><i class='fas fa-trash'></i> Delete</a>";
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
  $(document).on('click','.addCategory',function(){
		$("#id").val("");
		$(".modal-title").text("Add Category");
		$('#categoryModal').modal('show');
	});
    $(document).on('click','.editCategory',function(){
		var id=$(this).attr("data-id");
        var category_name=$(this).attr("data-category_name");
        var page=$(this).attr("data-page");
        $("#id").val(id);
        $("#category_name").val(category_name);
        $("#page").val(page);
		$(".modal-title").text("Edit Category");
		$('#categoryModal').modal('show');
	});
    $(document).on('click','.deleteCategory',function(){
		var id=$(this).attr("data-id");
        $("#id").val(id);
		$(".modal-title").text("Delete Category");
		$('#deleteCategoryModal').modal('show');
	});
 $(function() {
 $("form[name='category-form']").validate({
    rules: {
        category_name: "required",
        page: "required",
      },
    messages: {
        category_name: "<span style='color:red'>Please enter category</span>",
        page: "<span style='color:red'>Please enter page no</span>"
    },
    submitHandler: function(form) {
     var id = $('#id').val();
     var category_name = $('#category_name').val();
     var page = $('#page').val();
     var token = $('#csrf').val();
     var type = 1;
     var form_data = new FormData();
    form_data.append("id", id);
    form_data.append("category_name", category_name);
    form_data.append("page", page);
    form_data.append("_token", token);
    form_data.append("type", type);
    $('.btnBlock').prop('disabled', true);
    $('.spinner-border').removeClass('d-none');
     $.ajax({
             url: "/addEditCategory",
             type: "POST",
             data: form_data,
             cache: false,
             contentType: false,
             processData: false,
             success: function(data){
                 var obj = JSON.parse(data);
                 if(obj.sucesss==200)
                 {
                    $('#categoryModal').modal('hide');
                    $('#category-form').trigger("reset");
                    toastr.success(obj.message, 'Success',{timeOut: 5000});
                    $('.btnBlock').prop('disabled', false);
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
        }
    });
});

    $(document).on('click','.deleteCategoryAction',function(){
     var id = $('#id').val();
     var token = $('#csrf').val();
     var type = 1;
     var form_data = new FormData();
    form_data.append("id", id);
    form_data.append("_token", token);
    form_data.append("type", type);
    $('.spinner-border').removeClass('d-none');
    $('.btnBlock').prop('disabled', true);
     $.ajax({
             url: "/deleteCategoryAction",
             type: "POST",
             data: form_data,
             cache: false,
             contentType: false,
             processData: false,
             success: function(data){
                 var obj = JSON.parse(data);
                 if(obj.sucesss==200)
                 {
                    $('#deleteCategoryModal').modal('hide');
                    toastr.success(obj.message, 'Success',{timeOut: 5000});
                    getData();				
                 }
                 else
                 {
                    toastr.success(obj.message, 'Error',{timeOut: 5000});
                 } 
                  $('.spinner-border').addClass('d-none');
                  $('.btnBlock').prop('disabled', false);
             }
         });
        });
</script>

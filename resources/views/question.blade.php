@include('header')
@include('sidebar')  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1>Questions</h1>
          </div>
          <div class="col-sm-2">
          <button type="button" class="btn btn-outline-primary btn-block addQuestion"><i class="fa fa-plus"></i> Add Question</button>
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
                <h3 class="card-title">Questions List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped myTable">
                  <thead>
                  <tr>
                    <th>Sr.#</th>
                    <th>Category</th>
                    <th>Question</th>
                    <th>How many answers?</th>
                    <th>Sort Order</th>
                    <th>Add Button</th>
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
  <div class="modal fade" id="questionModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form name="question-form" id="question-form">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category*</label>
                    <select class="form-control" id="category_id" name="category_id">
                        <option value="">Select Category</option>
                        @if(isset($category))
                        @foreach($category as $val)
                        <option value="{{$val->id}}">{{$val->category_name}}</option>
                        @endforeach
                        @endif
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Question*</label>
                    <textarea type="text" class="form-control" id="question" name="question" placeholder="Enter question"></textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Upto*</label>
                    <input type="number" class="form-control" id="upto" name="upto" placeholder="How many answers">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Sort Order*</label>
                    <input type="number" class="form-control" id="sortOrder" name="sortOrder" placeholder="Enter Sort Order">
                  </div>

                  <div class="form-check">
                  <input type="checkbox" class="form-check-input" value="1" name="addButton" id="addButton">
                  <label class="form-check-label" for="exampleCheck1">Add Button</label>
                  </div>

                  <input type="hidden" name="id" id="id">
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
<div class="modal fade" id="deleteQuestionModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <div><strong>Are you sure to delete this record?</strong></div>
            <div><span>It'll also delete its chield data e.g. information & answers .</span></div>
           <input type="hidden" name="id" id="id">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary btnBlock deleteQuestionAction">
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
                "url": "{{ route('questionTableList') }}",
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
    { "data": "question" },
    { "data": "upto" },
    { "data": "sortOrder" },
    {
            "data": "addButton",
            "render": function(data, type, row) {
                return data == 1 ? 'Yes' : 'No';
            }
    },
    {
        "render": function (data, type, full, meta){
            return "<a href='#' class='editQuestion' data-id='"+full.id+"' data-category_id='"+full.category_id+"' data-question='"+full.question+"' data-upto='"+full.upto+"' data-sortOrder='"+full.sortOrder+"' data-addButton='"+full.addButton+"'><i class='fas fa-edit text-primary' data-toggle='tooltip' data-placement='top' title='Edit'></i></a> <a href='#' class='deleteQuestion' data-id='"+full.id+"'><i class='fas fa-trash text-danger' data-toggle='tooltip' data-placement='top' title='Delete'></i></a>";
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
  $(document).on('click','.addQuestion',function(){
		$("#id").val("");
        $("#category_id").val("");
        $("#question").val("");
        $("#upto").val("");
        $("#sortOrder").val("");
        $('#addButton').prop('checked', false);
        $(".modal-title").text("Add Question");
        $('#questionModal').modal('show');
	});
    $(document).on('click','.editQuestion',function(){
		var id=$(this).attr("data-id");
        var category_id=$(this).attr("data-category_id");
        var question=$(this).attr("data-question");
        var upto=$(this).attr("data-upto");
        var sortOrder=$(this).attr("data-sortOrder");
        var addButton=$(this).attr("data-addButton");
        $("#id").val(id);
        $("#category_id").val(category_id);
        $("#question").val(question);
        $("#upto").val(upto);
        $("#sortOrder").val(sortOrder);
        var condition = addButton==1 ? true : false;
        $('#addButton').prop('checked', condition);
        $(".modal-title").text("Edit Question");
        $('#questionModal').modal('show');
	});
    $(document).on('click','.deleteQuestion',function(){
		var id=$(this).attr("data-id");
        $("#id").val(id);
		$(".modal-title").text("Delete Question");
		$('#deleteQuestionModal').modal('show');
	});
 $(function() {
 $("form[name='question-form']").validate({
    rules: {
        category_id: "required",
        question: "required",
        upto: "required",
        sortOrder: "required",
      },
    messages: {
        category_id: "<span style='color:red'>Please select category</span>",
        question: "<span style='color:red'>Please enter question</span>",
        upto: "<span style='color:red'>Please enter how many answers?</span>",
        sortOrder: "<span style='color:red'>Please enter sort order</span>"
    },
    submitHandler: function(form) {
     var id = $('#id').val();
     var category_id = $('#category_id').val();
     var question = $('#question').val();
     var upto = $('#upto').val();
     var sortOrder = $('#sortOrder').val();
     var addButton = $('#addButton').val();
     if ($('#addButton').prop('checked')) 
     {
      addButton =1;
     } 
     else 
     {
          addButton =0;
     }
     var token = $('#csrf').val();
     var type = 1;
     var form_data = new FormData();
    form_data.append("id", id);
    form_data.append("category_id", category_id);
    form_data.append("question", question);
    form_data.append("upto", upto);
    form_data.append("sortOrder", sortOrder);
    form_data.append("addButton", addButton);
    form_data.append("_token", token);
    form_data.append("type", type);
    $('.btnBlock').prop('disabled', true);
    $('.spinner-rotation').removeClass('d-none');
     $.ajax({
             url: "{{ route('addEditQuestion') }}",
             type: "POST",
             data: form_data,
             cache: false,
             contentType: false,
             processData: false,
             success: function(data){
                 var obj = JSON.parse(data);
                 if(obj.sucesss==200)
                 {
                    $('#questionModal').modal('hide');
                    $('#question-form').trigger("reset");
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

    $(document).on('click','.deleteQuestionAction',function(){
     var id = $('#id').val();
     var token = $('#csrf').val();
     var type = 1;
     var form_data = new FormData();
    form_data.append("id", id);
    form_data.append("_token", token);
    form_data.append("type", type);
    $('.spinner-rotation').removeClass('d-none');
    $('.btnBlock').prop('disabled', true);
     $.ajax({
             url: "{{ route('deleteQuestionAction') }}",
             type: "POST",
             data: form_data,
             cache: false,
             contentType: false,
             processData: false,
             success: function(data){
                 var obj = JSON.parse(data);
                 if(obj.sucesss==200)
                 {
                    $('#deleteQuestionModal').modal('hide');
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

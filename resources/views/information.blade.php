@include('header')
@include('sidebar')  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1>Question Information</h1>
          </div>
          <div class="col-sm-2">
          <button type="button" class="btn btn-outline-primary btn-block addInfo"><i class="fa fa-plus"></i> Add Information</button>
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
                <h3 class="card-title">Question Info List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped myTable">
                  <thead>
                  <tr>
                    <th>Sr.#</th>
                    <th>Info Content</th>
                    <th>Question</th>
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
  <div class="modal fade" id="infoModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form name="info-form" id="info-form">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Info Content*</label>
                    <input type="text" class="form-control" id="info_content" name="info_content" placeholder="Enter Question Information">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Select Question*</label>
                    <select class="form-control" id="question_id" name="question_id">
                        <option value="">Select Question</option>
                        @foreach($questions as $question)
                        <option value="{{$question->id}}">{{$question->question}}</option>
                        @endforeach
                    </select>
                  </div>

                  <input type="hidden" name="info_id" id="info_id">
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
<div class="modal fade" id="deleteInfoModal">
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
           <input type="hidden" name="info_id" id="info_id">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary deleteInfoAction">Delete</button>
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
                "url": "/infoTableList",
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
    { "data": "info_content" },
    { "data": "question" },
    {
        "render": function (data, type, full, meta){
            return "<a class='btn btn-primary btn-sm editInfo' data-info_id='"+full.info_id+"' data-info_content='"+full.info_content+"' data-question_id='"+full.question_id+"'><i class='fas fa-edit'></i> Edit</a> <a class='btn btn-danger btn-sm deleteInfo' data-info_id='"+full.info_id+"'><i class='fas fa-trash'></i> Delete</a>";
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
  $(document).on('click','.addInfo',function(){
		$("#info_id").val("");
        $("#info_content").val("");
        $("#question_id").val("");
		$(".modal-title").text("Add Question Info");
		$('#infoModal').modal('show');
	});
    $(document).on('click','.editInfo',function(){
		var info_id=$(this).attr("data-info_id");
        var info_content=$(this).attr("data-info_content");
        var question_id=$(this).attr("data-question_id");
        $("#info_id").val(info_id);
        $("#info_content").val(info_content);
        $("#question_id").val(question_id);
		$(".modal-title").text("Edit Question Info");
		$('#infoModal').modal('show');
	});
    $(document).on('click','.deleteInfo',function(){
		var info_id=$(this).attr("data-info_id");
        $("#info_id").val(info_id);
		$(".modal-title").text("Delete Question Info");
		$('#deleteInfoModal').modal('show');
	});
 $(function() {
 $("form[name='info-form']").validate({
    rules: {
        info_content: "required",
        question_id: "required",
      },
    messages: {
        info_content: "<span style='color:red'>Please enter question information</span>",
        question_id: "<span style='color:red'>Please select question</span>"
    },
    submitHandler: function(form) {
     var info_id = $('#info_id').val();
     var info_content = $('#info_content').val();
     var question_id = $('#question_id').val();
     var token = $('#csrf').val();
     var type = 1;
     var form_data = new FormData();
    form_data.append("info_id", info_id);
    form_data.append("info_content", info_content);
    form_data.append("question_id", question_id);
    form_data.append("_token", token);
    form_data.append("type", type);
    $('.btnBlock').prop('disabled', true);
     $.ajax({
             url: "/addEditInfo",
             type: "POST",
             data: form_data,
             cache: false,
             contentType: false,
             processData: false,
             success: function(data){
                 var obj = JSON.parse(data);
                 if(obj.sucesss==200)
                 {
                    $('#infoModal').modal('hide');
                    $('#info-form').trigger("reset");
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

    $(document).on('click','.deleteInfoAction',function(){
     var info_id = $('#info_id').val();
     var token = $('#csrf').val();
     var type = 1;
     var form_data = new FormData();
    form_data.append("info_id", info_id);
    form_data.append("_token", token);
    form_data.append("type", type);
     $.ajax({
             url: "/deleteInfoAction",
             type: "POST",
             data: form_data,
             cache: false,
             contentType: false,
             processData: false,
             success: function(data){
                 var obj = JSON.parse(data);
                 if(obj.sucesss==200)
                 {
                    $('#deleteInfoModal').modal('hide');
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

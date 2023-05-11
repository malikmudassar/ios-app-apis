@include('header')
@include('sidebar')  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1>Answers</h1>
          </div>
          <div class="col-sm-2">
          <button type="button" class="btn btn-outline-primary btn-block addAnswer"><i class="fa fa-plus"></i> Add Answer</button>
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
                <h3 class="card-title">Answers List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped myTable">
                  <thead>
                  <tr>
                    <th>Sr.#</th>
                    <th>Category</th>
                    <th>Question</th>
                    <th>Answers</th>
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
  <div class="modal fade" id="answerModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form name="answer-form" id="answer-form">
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
                    <label for="exampleInputEmail1">Select Question*</label>
                    <select class="form-control questionData" id="question_id" name="question_id">
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Answer*</label>
                    <textarea type="text" class="form-control" id="answer_statement" name="answer_statement[]" placeholder="Enter answer"></textarea>
                  </div>

                  <div class="form-group addMoreFields">
                  </div>
                  <button type="button" class="btn btn-sm btn-success add-more"><i class="fa fa-plus"></i>Add More</button>

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
<div class="modal fade" id="deleteAnswerModal">
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
              <button type="button" class="btn btn-primary btnBlock deleteAnswerAction">
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
                "url": "{{ route('answerTableList') }}",
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
    { "data": "answer_statement" },
    {
        "render": function (data, type, full, meta){
            return "<a href='#' class='editAnswer' data-id='"+full.id+"' data-category_id='"+full.category_id+"' data-question_id='"+full.question_id+"' data-answer_statement='"+full.answer_statement+"'><i class='fas fa-edit text-primary' data-toggle='tooltip' data-placement='top' title='Edit'></i></a> <a href='#' class='deleteAnswer' data-id='"+full.id+"'><i class='fas fa-trash text-danger' data-toggle='tooltip' data-placement='top' title='Delete'></i></a>";
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
  $(document).on('click','.addAnswer',function(){
		$("#id").val("");
        $("#category_id").val("");
        $("#question_id").val("");
        $("#answer_statement").val("");
        $(".modal-title").text("Add Answer");
        $(".addMoreFields").html("");
        $(".add-more").removeClass("d-none");
        $('#answerModal').modal('show');
	});
    $(document).on('click','.editAnswer',function(){
		    var id=$(this).attr("data-id");
        var category_id=$(this).attr("data-category_id");
        var question_id=$(this).attr("data-question_id");
        var answer_statement=$(this).attr("data-answer_statement");
        $("#id").val(id);
        $("#category_id").val(category_id);
        $("#answer_statement").val(answer_statement);
        if(category_id.length > 0 || category_id !='' || category_id !=null)
        {
        var token = $('#csrf').val();
        var type = 1;
        var form_data = new FormData();
        form_data.append("category_id", category_id);
        form_data.append("_token", token);
        form_data.append("type", type);
            $.ajax({
                url: "{{ route('categoryDropdownFilter') }}",
                type: "POST",
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data){
                    var obj = JSON.parse(data);
                    if(obj.sucesss==200)
                    {
                        var html = '<option value="">Select Question</option>';
                        for (var i = 0; i < obj.data.length; i++) 
                        {
                            var selected = question_id==obj.data[i]['id'] ? 'selected' : '';
                            html += '<option '+selected+' value=' +obj.data[i]['id']+ '>' +obj.data[i]['question']+ '</option>';
                        }
                        $('.questionData').html(html);			
                    }
                }
            });  
        }
    $('.add-more').addClass('d-none');
		$(".modal-title").text("Edit Answer");
    $(".addMoreFields").html("");
		$('#answerModal').modal('show');
	});
    $(document).on('click','.deleteAnswer',function(){
		var id=$(this).attr("data-id");
        $("#id").val(id);
		$(".modal-title").text("Delete Answer'");
		$('#deleteAnswerModal').modal('show');
	});
 $(function() {
 $("form[name='answer-form']").validate({
    rules: {
        category_id: "required",
        question_id: "required",
        answer_statement: "required",
      },
    messages: {
        category_id: "<span style='color:red'>Please select category</span>",
        question_id: "<span style='color:red'>Please select question</span>",
        answer_statement: "<span style='color:red'>Please enter answer</span>"
    },
    submitHandler: function(form) {
     var id = $('#id').val();
     var category_id = $('#category_id').val();
     var question_id = $('#question_id').val();
    //nutiple answers
     var answer_statement = ''; // initialize variable
     $('textarea[name="answer_statement[]"]').each(function() { // iterate through each Answer field
        answer_statement += $(this).val() + ','; // concatenate the value with comma separator
     });
     answer_statement = answer_statement.slice(0, -1); // remove the last comma

    var token = $('#csrf').val();
    var type = 1;
    var form_data = new FormData();
    form_data.append("id", id);
    form_data.append("category_id", category_id);
    form_data.append("question_id", question_id);
    form_data.append("answer_statement", answer_statement);
    form_data.append("_token", token);
    form_data.append("type", type);
    $('.btnBlock').prop('disabled', true);
    $('.spinner-border').removeClass('d-none');
     $.ajax({
             url: "{{ route('addEditAnswer') }}",
             type: "POST",
             data: form_data,
             cache: false,
             contentType: false,
             processData: false,
             success: function(data){
                 var obj = JSON.parse(data);
                 if(obj.sucesss==200)
                 {
                    $('#answerModal').modal('hide');
                    $('#answer-form').trigger("reset");
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

    $(document).on('click','.deleteAnswerAction',function(){
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
             url: "{{ route('deleteAnswerAction') }}",
             type: "POST",
             data: form_data,
             cache: false,
             contentType: false,
             processData: false,
             success: function(data){
                 var obj = JSON.parse(data);
                 if(obj.sucesss==200)
                 {
                    $('#deleteAnswerModal').modal('hide');
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

$('#category_id').on('change', function() {
    var selectedValue = $(this).val();
    if(selectedValue.length > 0 || selectedValue !='' || selectedValue !=null)
    {
     
     var token = $('#csrf').val();
     var type = 1;
     var form_data = new FormData();
    form_data.append("category_id", selectedValue);
    form_data.append("_token", token);
    form_data.append("type", type);
        $.ajax({
             url: "{{ route('categoryDropdownFilter') }}",
             type: "POST",
             data: form_data,
             cache: false,
             contentType: false,
             processData: false,
             success: function(data){
                 var obj = JSON.parse(data);
                 if(obj.sucesss==200)
                 {
                    var html = '<option value="">Select Question</option>';
                      for (var i = 0; i < obj.data.length; i++) 
                      {
                        html += '<option value=' +obj.data[i]['id']+ '>' +obj.data[i]['question']+ '</option>';
                      }
                      $('.questionData').html(html);			
                 } 
             }
         });  
    }
});

$(document).ready(function(){
    var wrapper = $(".addMoreFields"); //Fields wrapper
    var add_button = $(".add-more"); //Add button ID
    var remove_button = $(".remove"); //Remove button ID
    
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        $(wrapper).append('<div><label for="exampleInputEmail1">Answer*</label><textarea type="text" class="form-control" id="answer_statement" name="answer_statement[]" placeholder="Enter answer"></textarea><a href="#" class="remove_field">Remove</a><br></div>'); //add input box
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove(); //remove text box
    })
});


</script>

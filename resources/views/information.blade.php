@include('header')
@include('sidebar') 
<style>
  .content .more {
  display: none;
}

.content .dots,
.content .read-more {
  display: inline;
}

.content.show-less .more {
  display: inline;
}
</style> 
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
                    <textarea type="text" class="form-control" id="info_content" name="info_content" placeholder="Enter Question Information"></textarea>
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
              <button type="button" class="btn btn-primary btnBlock deleteInfoAction">
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
CKEDITOR.replace('info_content');
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
                "url": "{{ route('infoTableList') }}",
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
  "data": "info_content",
  "render": function(data, type, full, meta) {
    if (type === "display") {
      if (data.length > 50) {
        return '<div class="content">' + data.substr(0, 50) +
          '<span class="dots">...</span>' +
          '<span class="more">' + data.substr(50) + '</span>' +
          '<a href="#" class="readMore read-more">Read more</a></div>';
      } else {
        return data;
      }
    }
    return data;
  }
},
    { "data": "question" },
    {
        "render": function (data, type, full, meta){
            return "<a href='#' class='editInfo' data-info_id='"+full.info_id+"' data-info_content='"+full.info_content+"' data-question_id='"+full.question_id+"'><i class='fas fa-edit text-primary' data-toggle='tooltip' data-placement='top' title='Edit'></i></a> <a href='#' class='deleteInfo' data-info_id='"+full.info_id+"'><i class='fas fa-trash text-danger' data-toggle='tooltip' data-placement='top' title='Delete'></i></a>";
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
    CKEDITOR.instances.info_content.setData("");
        $("#question_id").val("");
		$(".modal-title").text("Add Question Info");
		$('#infoModal').modal('show');
	});
    $(document).on('click','.editInfo',function(){
		var info_id=$(this).attr("data-info_id");
        var info_content=$(this).attr("data-info_content");
        var question_id=$(this).attr("data-question_id");
        $("#info_id").val(info_id);
        CKEDITOR.instances.info_content.setData(info_content);
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
        question_id: "required",
      },
    messages: {
        question_id: "<span style='color:red'>Please select question</span>",
    },
    submitHandler: function(form) {
     var info_id = $('#info_id').val();
     var info_content = CKEDITOR.instances.info_content.getData();
     if(info_content=='' || info_content==null)
     {
      toastr.error('Please enter question information', 'Error',{timeOut: 5000});return false;
     }
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
    $('.spinner-border').removeClass('d-none');
     $.ajax({
             url: "{{ route('addEditInfo') }}",
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
                   $('.btnBlock').prop('disabled', false);
                   $('.spinner-border').addClass('d-none');
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
    $('.spinner-border').removeClass('d-none');
    $('.btnBlock').prop('disabled', true);
     $.ajax({
             url: "{{ route('deleteInfoAction') }}",
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
                  $('.spinner-border').addClass('d-none');
                  $('.btnBlock').prop('disabled', false);
             }
         });
        });

        $(document).on('click', '.read-more', function(e) {
          e.preventDefault();
          $(this).closest('.content').addClass('show-less');
          $(this).closest('.content').find('.dots').hide();
          $(this).closest('.readMore').addClass('show-less');
          $(this).closest('.readMore').removeClass('read-more');
          $(this).closest('.readMore').text('Show-less');
        });
        $(document).on('click', '.show-less', function(e) {
          e.preventDefault();
          $(this).closest('.content').removeClass('show-less');
          $(this).closest('.content').find('.dots').show();
          $(this).closest('.readMore').removeClass('show-less');
          $(this).closest('.readMore').addClass('read-more');
          $(this).closest('.readMore').text('Read-more');
        });

</script>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Seek | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/webAssets') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ url('/webAssets') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/webAssets') }}/dist/css/adminlte.min.css">
  
</head>
<body class="hold-transition login-page">
<input type="hidden" id="csrf" value="{{ csrf_token() }}">
<div class="login-box">
  <div class="login-logo">
    <a href="{{ url('/webAssets') }}/index2.html"><b>Admin</b>Seek</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to continue</p>

      <form name="login-form" id="login-form">
        <div class="input-group mb-3">
          <input type="email" id="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            
          </div>
          <!-- /.col -->
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btnBlock">
                <span class="btn-text">Sign In</span>
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
        </div>
          <!-- /.col -->
        </div>
      </form>

      

      <p class="mb-1">
        <a href="forgot-password.html">forgot password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<!-- Include Toastr library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/webAssets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('/webAssets') }}/dist/js/adminlte.min.js"></script>
</body>
</html>

<script>
$(function() {
 $("form[name='login-form']").validate({
    rules: {
        email: "required",
        password: "required",
      },
    messages: {
        email: "<span style='color:red'>Please enter valid email</span>",
        password: "<span style='color:red'>Please enter password</span>"
    },
    submitHandler: function(form) {
     var email = $('#email').val();
     var password = $('#password').val();
     var token = $('#csrf').val();
     var type = 1;
     var form_data = new FormData();
    form_data.append("email", email);
    form_data.append("password", password);
    form_data.append("_token", token);
    form_data.append("type", type);
    $('.btnBlock').prop('disabled', true);
    $('.spinner-border').removeClass('d-none');
     $.ajax({
             url: "{{ route('adminLogin') }}",
             type: "POST",
             data: form_data,
             cache: false,
             contentType: false,
             processData: false,
             success: function(data){
                 var obj = JSON.parse(data);
                 if(obj.sucesss==200)
                 {
                    $('#login-form').trigger("reset");
                    toastr.success(obj.message, 'Success',{timeOut: 5000});
                    setTimeout(function() {
                        $('.spinner-border').addClass('d-none');
                    window.location.href = "{{ route('dashboard') }}/";
                    }, 2000);			
                 }
                 else
                 {
                    $('.spinner-border').addClass('d-none');
                    toastr.error(obj.message, 'Error',{timeOut: 5000});
                 } 
                    $('.btnBlock').prop('disabled', false);
                    
             }
         });
        }
    });
});
</script>

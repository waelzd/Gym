<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gym Management System | Recover Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href=" {{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href=" {{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href=" {{ asset('admin/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
   <!-- Centered reset passowrd Box -->
  <div class="d-flex justify-content-center align-items-center vh-100">
    <div class="hold-transition login-box">
  <!-- /.rreset-password-logo -->
  <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h1><b>Gym Management System</b></h1>
            </div>
        <div class="card-body">
   @if(session()->has("success"))
  <div class="d-flex justify-content-center">
    <div class="alert alert-success text-center w-100">
      {{ session()->get("success") }}
    </div>
  </div>
@endif

      @if(session()->has("error"))
      <div class="d-flex justify-content-center">
    <div class="alert alert-danger text-center w-100">
        {{session()->get("error")}}
      </div>
</div>
      @endif
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

      <form action="{{ route('password.update') }}" method="post" id="quickForm" novalidate>
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">

    <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        <input type="password" name="password" class="form-control" id="password" required placeholder="Password">
      </div>
    </div>

    <div class="form-group">
    <label for="exampleInputConfirmPassword1">Confirm Password</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required placeholder="Confirm Password">
            
          </div>
    </div>

    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
        </div>
    </div>
</form>


      <p class="mt-3 mb-1">
        <a href="/login">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
  <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- jquery-validation -->
  <script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>

  <!-- AdminLTE App -->
  <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>


<script>
  $(document).ready(function() {
    // Fade out success and error messages after 10 seconds (10000 ms)
    setTimeout(function() {
      $(".alert").fadeOut('slow');
    }, 10000); // 10000 ms = 10 seconds

$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      form.submit();
    }
  });

  $('#quickForm').validate({
    rules: {
      password: {
        required: true,
        minlength: 8
      },
      password_confirmation: {
        required: true,
        equalTo: "#password" // Ensures password match
      }
    },
    messages: {
      password: {
        required: "Please enter your password",
        minlength: "Your password must be at least 8 characters long"
      },
      password_confirmation: {
        required: "Please confirm your password",
        equalTo: "Passwords do not match"
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
  });
</script>



</body>
</html>

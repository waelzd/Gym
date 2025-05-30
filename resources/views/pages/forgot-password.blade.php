<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gym Management System | Forgot Password</title>

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
   <!-- Centered Login Box -->
  <div class="d-flex justify-content-center align-items-center vh-100">
    <div class="hold-transition login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <h1><b>Gym Management System</b></h1>
            </div>
        <div class="card-body">
        @if (session('success'))
  <div class="alert alert-success text-center w-100">
    {{ session('success') }}
  </div>
@endif


        @if ($errors->any())
  <div class="alert alert-danger text-center w-100">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form action="{{ route('password.email') }}" method="post" id="quickForm" novalidate>
  @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        <input type="email" name="email" class="form-control" id="email" required placeholder="Email">
      </div>
    </div>
  <div class="row">
    <div class="col-12">
      <button type="submit" class="btn btn-primary btn-block">Request new password</button>
    </div>
  </div>
</form>


      <p class="mt-3 mb-1">
        <a href="/login">Login</a>
      </p>
      <p class="mb-0">
        <a href="/register" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
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
    }, 5000); // 10000 ms = 10 seconds

$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      form.submit();
    }
  });

  $('#quickForm').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
    },
    messages: {
      email: {
        required: "Please enter your email",
        email: "Please enter a valid email"
      },
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

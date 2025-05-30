<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gym Management System | Registration</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href=" {{ asset('../../../admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href=" {{ asset('../../../admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href=" {{ asset('../../../admin/dist/css/adminlte.min.css') }}">

  <style>
    .h1:hover {
      color: #0000FF !important; 
    }
    .register-box {
      width: 400px; /* Set a larger width */
      max-width: 100%; /* Ensure it remains responsive */
  }
  </style>
</head>

<body class="hold-transition register-page">
<div class="d-flex justify-content-center align-items-center vh-100">
<div class="register-box">
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
      <p class="login-box-msg">Register a new membership</p>
      <form method="POST" action="{{ route('register.post') }}" id="quickForm" novalidate>
      @csrf
      <div class="form-group">
        <label for="exampleInputUsername1">Username</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-user"></span>
              </div>
            </div>
            <input type="text" name="username" class="form-control" id="username" placeholder="Enter your Username">
          </div>
      </div>

      <div class="form-group">
        <label for="exampleInputGymName1">Gym Name</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        <input type="text" name="gymname" class="form-control" id="gymname" required placeholder="Enter Gym Name">
      </div>
    </div>

    <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        <input type="text" name="email" class="form-control" id="exampleInputEmail1" required placeholder="Email">
      </div>
    </div>

    <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        <input type="password" name="password" class="form-control" id="password" required placeholder="Password">
        <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fa fa-eye toggle-password" toggle="#password" style="cursor: pointer;"></span>
                    </div>
                  </div>
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
            <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fa fa-eye toggle-password" toggle="#password_confirmation" style="cursor: pointer;"></span>
                    </div>
                  </div>
          </div>
    </div>

    <p class="mb-2">
        <a href="/login" class="text-primary">I already have an Account</a>
    </p>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary btn-block" id="register">Register</button>
    </div>
      </form>

    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
</div>
<!-- /.register-box -->

</body>
</html>

<!-- jQuery -->
<script src=" {{ asset('../../../admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="../../../admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jquery-validation -->
<script src=" {{ asset('../../../admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src=" {{ asset('../../../admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<!-- AdminLTE App -->
<script src=" {{ asset('../../../admin/dist/js/adminlte.min.js') }}"></script>


<script>
  $(document).on('click', '.toggle-password', function () {
    const input = $($(this).attr("toggle"));
    const icon = $(this);
    const isPassword = input.attr("type") === "password";
    input.attr("type", isPassword ? "text" : "password");
    icon.toggleClass("fa-eye fa-eye-slash");
  });
</script>

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
      username: {
        required: true,
        minlength: 4,
      },
      gymname: {
        required: true,
        minlength: 3, // Minimum length for gym name
      },
      email: {
        required: true,
        email: true,
      },
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
      username: {
        required: "Please enter your username",
        minlength: "Username must be at least 4 characters long"
      },
      gymname: {
        required: "Please enter your gym name",
        minlength: "Gym name must be at least 3 characters long"
      },
      email: {
        required: "Please enter your email",
        email: "Please enter a valid email"
      },
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
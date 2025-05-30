<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gym Management System | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href=" {{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href=" {{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href=" {{ asset('admin/dist/css/adminlte.min.css') }}">
  
  <style>
    .btn {
      width: 100% !important;
    }

    .h1:hover {
      color: #0000FF !important;
    }

    #home-icon{
      color: #0000FF;
      text-decoration: none;
    }

    #home {
      font-family: 'Source Sans Pro';
    }
    
    
  </style>
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
                {{ session()->get("error") }}
              </div>
            </div>
          @endif
          <p class="login-box-msg">Login to start your session</p>

          <form id="quickForm" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
              <label for="exampleInputUsername1">Username</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
                <input type="text" name="username" class="form-control" id="username" required placeholder="Username" value="{{ old('username') }}">
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

            <p class="mb-2">
              <a href="/forgot-password" class="text-primary">Forgot your password?</a>
            </p>

            <div class="mb-3">
              <button type="submit" class="btn btn-primary btn-block" id="login">Login</button>
            </div>

            <div class="mb-3">
              <a href="/register">
                <button type="button" class="btn btn-outline-primary" id="register">Register</button>
              </a>
            </div>

            
          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
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

    $.validator.setDefaults({
      submitHandler: function () {
        form.submit();
      }
    });

    $('#quickForm').validate({
      rules: {
        username: {
          required: true,
        },
        password: {
          required: true,
          minlength: 8
        },
      },
      messages: {
        username: {
          required: "Please enter your username",
        },
        password: {
          required: "Please enter your password",
          minlength: "Your password must be at least 8 characters long"
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
</script>


</body>
</html>
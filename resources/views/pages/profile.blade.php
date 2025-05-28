@extends('pages.app')

@section('content')
<style>
div:where(.swal2-container) button:where(.swal2-styled):where(.swal2-confirm) {
    border:rgb(51, 155, 25) !important;
    border-radius: var(--swal2-confirm-button-border-radius);
    background: initial;
    background-color: rgb(51, 155, 25) !important;
    color: #fff !important;
    font-size: 1em;
}

div:where(.swal2-container) button:where(.swal2-styled):where(.swal2-confirm):hover {
    border:rgb(51, 155, 25) !important;
    border-radius: var(--swal2-confirm-button-border-radius);
    background: initial;
    background-color: rgb(56, 180, 25) !important;
    color: #fff !important;
    font-size: 1em;
}
</style>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-2" style="font-weight: bold;">Profile Informations</h1>
      </div>
    </div>
  </div>
</div>



<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Profile Information</h3>
          </div>
          <form method="POST" action="" id="editProfile" novalidate>
            @csrf
            <div class="card-body">
              <input type="hidden" name="id" value="{{ Auth::user()->id }}">

              <div class="form-group">
                <label for="username">Username</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <span class="fa fa-user"></span>
                    </div>
                  </div>
                  <input type="text" name="username" class="form-control" id="username" required placeholder="Enter your Username" value="{{ Auth::user()->username }}">
                </div>
              </div>

              <div class="form-group">
                <label for="gymname">Gym Name</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <span class="fa fa-address-card"></span>
                    </div>
                  </div>
                  <input type="text" name="gymname" class="form-control" id="gymname" required placeholder="Enter Gym Name" value="{{ Auth::user()->gymname }}">
                </div>
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <span class="fa fa-envelope"></span>
                    </div>
                  </div>
                  <input type="text" name="email" class="form-control" id="email" required placeholder="Enter your Email" value="{{ Auth::user()->email }}">
                </div>
              </div>
            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Submit</button>
            </div>
          </form>
        </div>
      </div>

      <!-- right column -->
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Change Password</h3>
          </div>
          <form method="POST" action="" id="changePassowrd" novalidate>
            @csrf
            <div class="card-body">
              <input type="hidden" name="id" value="{{ Auth::user()->id }}">
              <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <span class="fa fa-lock"></span>
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
                <label for="password_confirmation">Confirm Password</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <span class="fa fa-lock"></span>
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
            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-primary" id="changeBtn">Change Password</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>







<!-- jquery-validation -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>

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
$(document).ready(function () {
  const originalValues = {
    username: $('#username').val(),
    gymname: $('#gymname').val(),
    email: $('#email').val()
  };

  function checkChanges() {
    const hasChanged =
      $('#username').val() !== originalValues.username ||
      $('#gymname').val() !== originalValues.gymname ||
      $('#email').val() !== originalValues.email;

    $('#submitBtn').prop('disabled', !hasChanged);
  }

  $('#username, #gymname, #email').on('input', checkChanges);

  $('#editProfile').validate({
    rules: {
      username: {
        required: true,
        minlength: 3
      },
      gymname: {
        required: true,
        minlength: 3
      },
      email: {
        required: true,
        email: true
      }
    },
    messages: {
      username: {
        required: "Please enter a username",
        minlength: "Your username must be at least 3 characters long"
      },
      gymname: {
        required: "Please enter your gym name",
        minlength: "Your gym name must be at least 3 characters long"
      },
      email: {
        required: "Please enter an email address",
        email: "Please enter a valid email address"
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element) {
      $(element).removeClass('is-invalid');
    },
    submitHandler: function (form) {
      Swal.fire({
        title: 'Update Profile?',
        text: "Are you sure you want to update your profile information?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33'
      }).then((result) => {
        if (result.isConfirmed) {
          const submitBtn = $('#submitBtn');
          submitBtn.html('<i class="fa fa-spinner fa-spin"></i> Updating...');
          submitBtn.prop('disabled', true);

          const userId = $('input[name="id"]').val(); // ✅ Fix: get user ID correctly
          const formData = $(form).serialize();

          $.ajax({
            url: '/update-profile/' + userId, // ✅ Fixed URL
            method: 'POST',
            data: formData,
            success: function(response) {
              // Update original values
              originalValues.username = $('#username').val();
              originalValues.gymname = $('#gymname').val();
              originalValues.email = $('#email').val();
              
              Swal.fire({
                title: 'Success!',
                text: 'Your profile has been updated successfully.',
                icon: 'success',
                confirmButtonColor: '#28a745'
              }).then(() => {
                 window.location.reload();
              });

              submitBtn.html('Submit');
              submitBtn.prop('disabled', true);
            },
            error: function(xhr) {
              let errorMessage = 'An error occurred while updating your profile.';

              if (xhr.responseJSON && xhr.responseJSON.errors) {
                errorMessage = Object.values(xhr.responseJSON.errors).join('<br>');
              }

              Swal.fire({
                title: 'Error!',
                html: errorMessage,
                icon: 'error'
              });

              submitBtn.html('Submit');
              submitBtn.prop('disabled', false);
            }
          });
        }
      });

      return false;
    }
  });
});
</script>



<script>
$(document).ready(function () {
  // Toggle password visibility
  $(document).on('click', '.toggle-password', function () {
    const input = $($(this).attr("toggle"));
    const isPassword = input.attr("type") === "password";
    input.attr("type", isPassword ? "text" : "password");
    $(this).toggleClass("fa-eye fa-eye-slash");
  });

  // Enable submit button when fields are non-empty
  $('#password, #password_confirmation').on('input', function () {
    const hasInput = $('#password').val().length > 0 && $('#password_confirmation').val().length > 0;
    $('#changeBtn').prop('disabled', !hasInput);
  });

  // Validate form on submit
  $('#changePassowrd').validate({
    rules: {
      password: {
        required: true,
        minlength: 8
      },
      password_confirmation: {
        required: true,
        equalTo: "#password"
      }
    },
    messages: {
      password: {
        required: "Please enter a password",
        minlength: "Password must be at least 8 characters"
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
    highlight: function (element) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element) {
      $(element).removeClass('is-invalid');
    },
    submitHandler: function (form) {
      Swal.fire({
        title: 'Change Password?',
        text: 'Are you sure you want to change your password?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed) {
          const changeBtn = $('#changeBtn');
          changeBtn.html('<i class="fa fa-spinner fa-spin"></i> Changing...');
          changeBtn.prop('disabled', true);

          $.ajax({
            url: '/change-password',
            method: 'POST',
            data: $('#changePassowrd').serialize(),
            success: function (response) {
              Swal.fire({
                title: 'Success!',
                text: 'Your password has been changed successfully.',
                icon: 'success',
                confirmButtonColor: '#28a745'
              }).then(() => {
                 window.location.reload();
              });

              $('#changePassowrd')[0].reset();
              changeBtn.html('Change Password');
              changeBtn.prop('disabled', true);
            },
            error: function (xhr) {
              console.error(xhr.responseText);
              let errorMessage = 'An error occurred.';

              if (xhr.responseJSON && xhr.responseJSON.errors) {
                errorMessage = Object.values(xhr.responseJSON.errors).join('<br>');
              }

              Swal.fire({
                title: 'Error!',
                html: errorMessage,
                icon: 'error'
              });

              changeBtn.html('Change Password');
              changeBtn.prop('disabled', false);
            }
          });
        }
      });

      return false;
    }
  });
});
</script>



<script>
$(document).ready(function () {
  const originalValues = {
    username: $('#username').val(),
    gymname: $('#gymname').val(),
    email: $('#email').val()
  };

  function checkChanges() {
    const hasChanged =
      $('#username').val() !== originalValues.username ||
      $('#gymname').val() !== originalValues.gymname ||
      $('#email').val() !== originalValues.email;

    $('#submitBtn').prop('disabled', !hasChanged);
  }

  $('#username, #gymname, #email').on('input', checkChanges);
});
</script>




@endsection
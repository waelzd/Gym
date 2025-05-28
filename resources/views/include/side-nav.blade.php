<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
  li a .active {
      background-color:  #007bff!important;
      color: white !important;
  }

  li a .active:hover {
      background-color:  #007bff !important;
      color: white !important;
  }

  nav ul li #side-link {
      position: relative;
      display: block;
      text-decoration: none;
      color: white !important;
      font-family: var(--font-home);
  }

  nav ul li #side-link:not(.active):hover {
      background-color:  #007bff !important;
      color: white !important;
  }

 
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <h3 class="brand-link">
      &nbsp;&nbsp;
      <img src="images/gym.png" style="width: 24px; height: 24px;margin-left: 8px;" alt="Gym Icon">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      {{ Auth::user()->gymname ?? 'Gym' }} Gym
    </h3>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="/dashboard" class="nav-link" id="side-link">
            <i class="fa fa-dashboard nav-icon"></i>
              <p>
              Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/subscribers" class="nav-link" id="side-link">
            <i class="bi bi-people-fill ml-1"></i>
            &nbsp;
              <p>
                Subscribers
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="/reports" class="nav-link" id="side-link">
            <i class="fa fa-bar-chart ml-1"></i>
            &nbsp;
              <p>
                Reports
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/profile" class="nav-link"  id="side-link">
              <i class="bi bi-person-circle ml-1"></i>
              &nbsp;
              <p>
                Personal Profile
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/login" class="nav-link" id="side-link">
            <i class="fa fa-sign-out ml-1"></i>
              &nbsp;
              <p>
                Logout
              </p>
            </a>
              </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <script>
  document.addEventListener("DOMContentLoaded", function () {
      // Get all navigation links
      const navLinks = document.querySelectorAll("#side-link");

      // Check the current URL and set the active link on page load
      const currentPath = window.location.pathname;
      navLinks.forEach(link => {
          if (link.getAttribute("href") === currentPath) {
              link.classList.add("active");
          }
      });

      // Add click event listener to update the active class
      navLinks.forEach(link => {
          link.addEventListener("click", function () {
              navLinks.forEach(nav => nav.classList.remove("active")); // Remove active class from all
              this.classList.add("active"); // Add active class to clicked link
          });
      });
  });
</script>

<!--
<script>
  <button class="show-example-btn" aria-label="Try me! Example: passing a parameter, you can execute something else for 'Cancel'">Try me!</button>
  const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: "btn btn-success",
    cancelButton: "btn btn-danger"
  },
  buttonsStyling: false
});
swalWithBootstrapButtons.fire({
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonText: "Yes, delete it!",
  cancelButtonText: "No, cancel!",
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    swalWithBootstrapButtons.fire({
      title: "Deleted!",
      text: "Your file has been deleted.",
      icon: "success"
    });
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire({
      title: "Cancelled",
      text: "Your imaginary file is safe :)",
      icon: "error"
    });
  }
});
</script>
-->
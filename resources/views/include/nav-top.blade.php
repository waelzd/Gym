<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

            <!-- Profile Dropdown Menu -->
            <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="bi bi-person-fill"></i>&nbsp;&nbsp;{{ Auth::user()->username }}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="/profile" class="dropdown-item">
            <i class="bi bi-person-circle mr-2"></i> Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="/login" class="dropdown-item">
            <i class="fa fa-sign-out mr-2"></i> Logout
          </a>
      </li>

      
    </ul>
  </nav>
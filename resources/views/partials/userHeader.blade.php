
  <aside class="sidebar">
    <div class="user-info">
      <div class="avatar">👤</div>
      <div class="email">admin@gmail.com</div>
    </div>
    <nav class="nav-menu">
      <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a>
      <a href="#">Department</a>
      <a href="#">Employee</a>
      <a href="#">Task</a>
      <a href="#">Task Status</a>
      <a href="#">Pages</a>
      <a href="#">Search Employee</a>
      <a href="#">Task Reports</a>
    </nav>
  </aside>

  <!-- Main Content Area -->
  <div class="main-content-area">

    <!-- Header/Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item ms-3">
          <a class="nav-link position-relative" href="#">
            <i class="material-icons" style="font-size:48px;color:red"></i>

            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              3
              <span class="visually-hidden">unread messages</span>
            </span>
          </a>
        </li>

        {{-- Profile Icon --}}
        <li class="nav-item ms-3 dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            👤 Admin
          </a>
          {{-- <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Logout</a></li>
          </ul> --}}
          <ul class="navbar-nav ms-auto">
  <li class="nav-item">
    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{ url('/about') }}">Settings</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}">Logout</a>
  </li>

</ul>
        </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="main-content">
      @yield('content')
    </div>

  </div>


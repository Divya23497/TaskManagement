<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <img src="{{ asset('images/logo.png') }}" style="height: 40px;width:150px;padding-left:20px;">

        <div class="collapse navbar-collapse">

            <ul class="navbar-nav ms-auto navbar-right-top">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{ url('/about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}"
                        href="{{ url('/contact') }}">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('login_page') ? 'active' : '' }}"
                        href="{{ url('/login_page') }}">Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('login_page_employee') ? 'active' : '' }}"
                        href="{{ url('/login_page_employee') }}">Employee</a>
                </li>
            </ul>
            {{-- <ul class="navbar-nav ms-auto">
        <li class="nav-item active"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">About</a></li>
         <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/admin') }}">Admin</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('/employee') }}">Employee</a></li>
      </ul> --}}
        </div>
    </div>
</nav>

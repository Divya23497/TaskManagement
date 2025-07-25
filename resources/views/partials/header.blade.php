<div class="dashboard-main-wrapper">
    <!-- ============================================================== -->
    <!-- navbar -->
    <!-- ============================================================== -->
    <div class="dashboard-header">
        <nav class="navbar navbar-expand-lg bg-dark fixed-top">


            <a class="navbar-brand" href="">

                <img class="img-fluid" src="{{ asset('images/logo.png') }}" style="width:110px;height:40px;" />
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-right-top ">

                    <li class="nav-item">
                        {{-- <div id="custom-search" class="top-search-bar">
                            <input class="form-control" type="text" placeholder="Search..">
                        </div> --}}
                        <a href="{{ route('notifications.index') }}" class="nav-link text-white position-relative">
                            <!-- Bell Icon -->
                            <svg class="w-6 h-6 text-gray-100" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.133 12.632v-1.8a5.406 5.406 0 0 0-4.154-5.262A.955.955 0 0 0 13 5.464V3.1a1 1 0 0 0-2 0v2.364a.955.955 0 0 0 .021.106A5.406 5.406 0 0 0 6.867 10.832v1.8C6.867 15.018 5 15.614 5 16.807 5 17.4 5 18 5.538 18h12.924C19 18 19 17.4 19 16.807c0-1.193-1.867-1.789-1.867-4.175ZM8.823 19a3.453 3.453 0 0 0 6.354 0H8.823Z" />
                            </svg>

                            <!-- Badge Count -->
                            @if ($notificationCount > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $notificationCount }}

                                </span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item dropdown nav-user">
                        <a class="nav-link nav-user-img" href="profile.php" id="navbarDropdownMenuLink2"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                src="{{ asset('images/logo.png') }}" alt=""
                                class="user-avatar-md rounded-circle"></a>
                        <div class="dropdown-menu nav-user-dropdown" style="right: 0; left: auto; min-width: 220px;"
                            aria-labelledby="navbarDropdownMenuLink2">
                            <div class="nav-user-info">
                                <h5 class="mb-0 text-white nav-user-name">
                                    {{-- {{ Auth::user()->name }} --}}
                                    {{ Auth::check() ? Auth::user()->name : 'Guest' }}

                                </h5>
                                <span class="status"></span><span class="ml-2">Available</span>
                            </div>
                            @auth
                                <a class="dropdown-item" href="{{ route('profile.edit', Auth::user()->id) }}">
                                    <i class="fas fa-user mr-2"></i> Profile
                                </a>
                                <a class="dropdown-item" href="{{ route('password.edit', Auth::user()->id) }}">
                                    <i class="fas fa-cog mr-2"></i> Change Password
                                </a>
                            @endauth

                            @guest
                                <a class="dropdown-item" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                                </a>
                            @endguest
                            <a class="dropdown-item" href="{{ route('logout') }}"><i
                                    class="fas fa-power-off mr-2"></i>Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

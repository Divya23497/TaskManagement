@auth
    @php
        $userType = Auth::user()->user_type;
    @endphp
@endauth

<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="dashboard.php">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php">
                            <i class="fa fa-fw fa-user-circle"></i>Dashboard
                            <span class="badge badge-success">6</span>
                        </a>
                    </li>

                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('departments') }}">
                                <i class="fa fa-building"></i>Department
                                <span class="badge badge-success">6</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users') }}">
                                <i class="fa fa-user-plus"></i>Employee
                                <span class="badge badge-success">6</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tasks') }}">
                                <i class="fa fa-tasks"></i>Tasks
                                <span class="badge badge-success">6</span>
                            </a>
                        </li>

                        @if (in_array($userType, ['admin', 'manager']))
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                                    data-target="#submenu-4" aria-controls="submenu-4">
                                    <i class="fas fa-file-alt"></i>Report
                                </a>
                                <div id="submenu-4" class="collapse submenu">
                                    <ul class="nav flex-column">
                                        <li class="nav-item"><a class="nav-link" href="{{ route('alltasks') }}">All Tasks</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ route('overdue_tasks') }}">Overdue Tasks</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ route('completed_tasks') }}">Completed Tasks This Week/Month</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ route('emptask_summary') }}">Employee-wise Task Summary</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ route('pending_tasks') }}">Pending Tasks List</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ route('estimated') }}">Time Tracking vs Estimated</a></li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (in_array($userType, ['designer', 'user']))
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                                    data-target="#submenu-4" aria-controls="submenu-4">
                                    <i class="fas fa-file-alt"></i>My Reports
                                </a>
                                <div id="submenu-4" class="collapse submenu">
                                    <ul class="nav flex-column">
                                        <li class="nav-item"><a class="nav-link" href="{{ route('completed_tasks') }}">My Completed Tasks</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ route('overdue_tasks') }}">My Overdue Tasks</a></li>
                                        <li class="nav-item"><a class="nav-link" href="{{ route('pending_tasks') }}">My Pending Tasks</a></li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">
                                <i class="fas fa-lock"></i>Logout
                                <span class="badge badge-success">6</span>
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </div>
</div>

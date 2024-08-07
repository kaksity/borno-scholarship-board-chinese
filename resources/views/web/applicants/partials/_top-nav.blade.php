<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <span class="text-dark">Account Management</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('applicant.change-password.display-change-password-form') }}"><i class="align-middle me-1" data-feather="user"></i>Change Password</a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('applicant.authentication.login.process-logout-form') }}" method="post">
                        @csrf
                        <input class="dropdown-item" type="submit" value="Logout">
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>

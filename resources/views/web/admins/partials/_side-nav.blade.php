<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">Admin</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.dashboard.display-dashboard-view') }}">
                    <i class="align-middle" data-feather="layers"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-header">
                Application
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.application-management.display-application-management') }}">
                    <i class="align-middle" data-feather="book-open"></i> <span class="align-middle">Applications</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.application-management.display-application-management') }}">
                    <i class="align-middle" data-feather="book-open"></i> <span class="align-middle">Reports</span>
                </a>
            </li>
    </div>
</nav>

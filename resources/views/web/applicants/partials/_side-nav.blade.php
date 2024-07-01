<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">Applicant</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Application
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('applicant.profile-management.display-profile-form') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('applicant.passport-management.display-passport-form') }}">
                    <i class="align-middle" data-feather="camera"></i> <span class="align-middle">Passport</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('applicant.upload-management.display-upload-document-form') }}">
                    <i class="align-middle" data-feather="upload-cloud"></i> <span class="align-middle">Uploads</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('applicant.application-processing.display-application-processing-form') }}">
                    <i class="align-middle" data-feather="book-open"></i> <span class="align-middle">Application</span>
                </a>
            </li>

    </div>
</nav>

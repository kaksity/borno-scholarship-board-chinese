<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('page-title', 'Borno State Scholarship Board')</title>
    @include('web.applicants.partials._styles')
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        <div class="card">
                            <div class="card-body">
                                @yield('main-content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('web.applicants.partials._scripts')
    @yield('custom_scripts')

</body>

</html>

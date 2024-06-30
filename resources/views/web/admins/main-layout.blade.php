<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('page-title', 'Borno State Scholarship Board')</title>
    @include('web.admins.partials._styles')
</head>

<body>
    <div class="wrapper">
        @include('web.admins.partials._side-nav')

        <div class="main">
            @include('web.admins.partials._top-nav')

            <main class="content">
                <div class="container-fluid p-0">

                    @yield('main-content')

                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="#" target="_blank"><strong>Borno State Scholarship Board</strong></a>&copy;
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @include('web.admins.partials._scripts')
    @yield('custom_scripts')
</body>

</html>

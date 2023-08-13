<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Static Navigation - SB Admin</title>
        <link href="{{asset("assets/css/styles.css")}}" rel="stylesheet" />
        <script src="{{asset("https://use.fontawesome.com/releases/v6.3.0/js/all.js")}}" crossorigin="anonymous"></script>
    </head>
    <body>
        @include('admin.components.nav')
        <div id="layoutSidenav">
            @include('admin.components.sidenav')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        @yield('admin_content')
                    </div>
                </main>
              @include('admin.components.footer')
            </div>
        </div>
        <script src="{{asset("https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js")}}" crossorigin="anonymous"></script>
        <script src="{{asset("assets/js/scripts.js")}}"></script>
    </body>
</html>

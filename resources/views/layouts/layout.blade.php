<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Inventory-POS</title>
        
        <link href="{{asset("assets/css/styles.css")}}" rel="stylesheet" />     
        <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">
        <link rel="stylesheet" href="{{asset("assets/css/toastify.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/css/dataTables.min.css")}}">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{asset("https://use.fontawesome.com/releases/v6.3.0/js/all.js")}}" crossorigin="anonymous"></script>
        <script src="{{asset("assets/js/dataTables.min.js")}}"></script>
        <script src="{{asset("assets/js/axios.min.js")}}"></script>
        <script src="{{asset("assets/js/toastify.js")}}"></script>
        <script src="{{asset("assets/js/main.js")}}"></script>
        <script src="{{asset("assets/js/scripts.js")}}"></script>
    </head>
    <body>
        <div id="loader" class="loaderSpiner d-none">
            <div class="load"></div>
        </div>
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
   
    </body>
</html>

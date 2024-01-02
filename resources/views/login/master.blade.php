<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tag wajib -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> @yield('title') </title>
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/reza-admin.min.css') }}">
    <link rel="icon" href="{{ asset('dist/img/Reza_Admin.ico') }}">
</head>
<body>

    <!-- navbar -->
    <nav class="navbar justify-content-start navbar--white">
        <a class="navbar__sidebar-toggler" href="#"><span class="fa fa-bars"></span></a>
        <a class="navbar-brand ml-3" href="#">
            <img src="[host mu]/dist/img/Reza_Admin.svg" width="120" alt="logo reza">
        </a>
    </nav>

    <!-- Sidebar -->
    @include('login/sidebar')

    @yield('main')

    <!-- footer -->
    <footer class="footer footer--ml-sidebar-width">
        <p class="mb-2 mb-sm-0">Copyright &copy; Website mu 2020. All rights reserved</p>
        <p>Version 1.0.2</p>
    </footer>

    <!-- Pertama jQuery, kemudian Bootstrap JS, dan Reza Admin JS -->
    <script src="{{ asset('/dist/js/jquery-3.5.1.slim.min.js') }}"></script>
    <script src="{{ asset('/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/dist/js/reza-admin.min.js') }}"></script>
</body>
</html>

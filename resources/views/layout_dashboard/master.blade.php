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
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

    <!-- <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />

    <link rel="icon" href="https://incrustwerush.org/img/site/icon.ico">
</head>
<body>

    <!-- navbar -->
    <nav class="navbar justify-content-start navbar--white">
        <a class="navbar__sidebar-toggler" href="#"><span class="fa fa-bars"></span></a>
        <a class="navbar-brand ml-3" href="#">
            <img src="https://incrustwerush.org/img/site/icon.ico" width="30px" alt="logo icwr">
            In Crust We Rush
        </a>
    </nav>

    <!-- Sidebar -->
    @include('layout_dashboard/sidebar')

    @yield('main')

    <!-- footer -->
    <footer class="footer footer--ml-sidebar-width">
        <p class="mb-2 mb-sm-0">Copyright &copy; In Crust We Rush. All rights reserved</p>
        <p>Version 2.0.0</p>
    </footer>

    <!-- Pertama jQuery, kemudian Bootstrap JS, dan Reza Admin JS -->
    <script src="{{ asset('/dist/js/jquery-3.5.1.slim.min.js') }}"></script>
    <script src="{{ asset('/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/dist/js/reza-admin.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->
    @stack("script")
</body>
</html>

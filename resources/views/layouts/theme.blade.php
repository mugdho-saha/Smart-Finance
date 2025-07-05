<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta content="Smart Finance" name="description"/>
    <meta content="mugdha_saha" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/metisMenu.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css"/>
</head>
<body>
<!-- Left Sidenav -->
<div class="left-sidenav">
    <!-- LOGO -->
    <div class="brand">
        <a class='logo' href='index.html'>
                    <span>
                        <img src="assets/images/logo-sm.png" alt="logo-small" class="logo-sm">
                    </span>
            <span>
                        <img src="assets/images/logo.png" alt="logo-large" class="logo-lg logo-light">
                        <img src="assets/images/logo-dark.png" alt="logo-large" class="logo-lg logo-dark">
                    </span>
        </a>
    </div>
    <!--end logo-->
    <div class="menu-content h-100" data-simplebar>
        <ul class="metismenu left-sidenav-menu">
            <li>
                <a href="{{route('dashboard')}}"> <i data-feather="home" class="align-self-center menu-icon"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="{{route('category.index')}}"> <i data-feather="grid" class="align-self-center menu-icon"></i><span>Category</span></a>
            </li>
        </ul>
    </div>
</div>
<!-- end left-sidenav-->


<div class="page-wrapper">
    <!-- Top Bar Start -->
    <div class="topbar">
        <!-- Navbar -->
        <nav class="navbar-custom">
            <ul class="list-unstyled topbar-nav float-end mb-0">

                <li class="dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-bs-toggle="dropdown"
                       href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <span class="ms-1 nav-user-name hidden-sm">{{ Auth::user()->name }}</span>
                        <img src="assets/images/users/user-5.jpg" alt="profile-user" class="rounded-circle thumb-xs"/>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class='dropdown-item' href='/profile'><i data-feather="user"
                                                                    class="align-self-center icon-xs icon-dual me-1"></i>
                            Profile</a>
                        <div class="dropdown-divider mb-0"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i data-feather="power" class="align-self-center icon-xs icon-dual me-1"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul><!--end topbar-nav-->

            <ul class="list-unstyled topbar-nav mb-0">
                <li>
                    <button class="nav-link button-menu-mobile">
                        <i data-feather="menu" class="align-self-center topbar-icon"></i>
                    </button>
                </li>
                <li class="creat-btn">
                    <div class="nav-link">
                        <a class=" btn btn-sm btn-soft-primary" href="#" role="button"><i class="fas fa-plus me-2"></i>New
                            Task</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- end navbar-->
    </div>
    <!-- Top Bar End -->

    <!-- Page Content-->
    <div class="page-content">
        <div class="container-fluid">
            @yield('content')
        </div><!-- container -->

        <footer class="footer text-center text-sm-start">
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script>
            SmartFinance <span class="text-muted d-none d-sm-inline-block float-end">Developed by Mugdha-Saha</span>
        </footer><!--end footer-->
    </div>
    <!-- end page content -->
</div>
<!-- end page-wrapper -->


<!-- jQuery -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/metismenu.min.js') }}"></script>
<script src="{{ asset('assets/js/waves.js') }}"></script>
<script src="{{ asset('assets/js/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>

</body>
</html>

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
    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<!-- Left Sidenav -->
<div class="left-sidenav">
    <!-- LOGO -->
    <div class="brand">
        <a class='logo' href='{{route('dashboard')}}'>
                    <span>
                        <img src="{{ asset('assets/images/logo-sm.png') }}" alt="logo-small" class="logo-sm">
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
                <a href="{{route('category.index')}}"> <i data-feather="grid"
                                                          class="align-self-center menu-icon"></i><span>Category</span></a>
            </li>
            <li>
                <a href="{{route('subcategory.index')}}"> <i data-feather="grid"
                                                             class="align-self-center menu-icon"></i><span>Sub-Category</span></a>
            </li>
            <li>
                <a href="{{route('income.index')}}"> <i data-feather="grid"
                                                        class="align-self-center menu-icon"></i><span>Income</span></a>
            </li>

            <li>
                <a href="{{route('expense.index')}}"> <i data-feather="grid"
                                                         class="align-self-center menu-icon"></i><span>Expense</span></a>
            </li>
            <li>
                <a href="{{route('report.index')}}"> <i data-feather="grid"
                                                         class="align-self-center menu-icon"></i><span>Reports</span></a>
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
                        <img src="{{asset('assets/images/users/user-5.jpg')}}" alt="profile-user"
                             class="rounded-circle thumb-xs"/>
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
                        <button type="button" class=" btn btn-sm btn-soft-danger" data-bs-toggle="modal"
                                data-bs-target="#expenseModal"><i class="fas fa-plus me-2"></i>
                            Add New Expense
                        </button>
                        {{--modal start--}}
                        <div class="modal fade" id="expenseModal" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title m-0" id="exampleModalDefaultLabel">Add New Expense</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <!--end modal-header-->

                                    {{--Add expense form--}}
                                    <form action="{{route('expense.store')}}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="exampleInputEmail1">Amount</label>
                                                        <input type="number" class="form-control" id="exampleInputEmail1"
                                                               placeholder="Amount" name="amount" autocomplete="off"
                                                               required>
                                                    </div>
                                                    <!-- Category Dropdown -->
                                                    <div class="mb-3">
                                                        <label class="form-label" for="category">Select Category</label>
                                                        <select class="form-select" id="categoryGlobal" name="cat_id" required>
                                                            <option value="" selected disabled>Select Category</option>
                                                            {{--global variable created in AppServiceProvider--}}
                                                            @foreach($global_categories as $category)
                                                                <option value="{{ $category->cat_id }}">{{ $category->cat_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <!-- Sub-Category Dropdown -->
                                                    <div class="mb-3">
                                                        <label class="form-label" for="subcategoryGlobal">Select Sub Category</label>
                                                        <select class="form-select" id="subcategoryGlobal" name="sub_cat_id" required>
                                                            <option value="" selected disabled>Select Sub Category</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="floatingTextarea2">Note</label>
                                                        <textarea class="form-control" name="note" placeholder="Note" id="floatingTextarea2" style="height: 100px"></textarea>
                                                    </div>
                                                </div>
                                            </div><!--end row-->
                                        </div><!--end modal-body-->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-soft-primary btn-sm">Add Expense</button>
                                            <button type="button" class="btn btn-soft-secondary btn-sm"
                                                    data-bs-dismiss="modal">Close
                                            </button>
                                        </div><!--end modal-footer-->
                                    </form>

                                </div><!--end modal-content-->
                            </div><!--end modal-dialog-->
                        </div>
                        {{--modal ends--}}
                    </div>
                </li>
                <li class="creat-btn">
                    <div class="nav-link">
                        <button type="button" class=" btn btn-sm btn-soft-primary" data-bs-toggle="modal"
                                data-bs-target="#incomeModal"><i class="fas fa-plus me-2"></i>
                            Add New Income
                        </button>
                        {{--modal start--}}
                        <div class="modal fade" id="incomeModal" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalDefaultLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title m-0" id="exampleModalDefaultLabel">Add New Income</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <!--end modal-header-->

                                    {{--Add expense form--}}
                                    <form action="{{route('income.store')}}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="exampleInputEmail1">Amount</label>
                                                        <input type="number" class="form-control" id="exampleInputEmail1"
                                                               placeholder="Amount" name="amount" autocomplete="off"
                                                               required>
                                                    </div>
                                                    <!-- Category Dropdown -->
                                                    <div class="mb-3">
                                                        <label class="form-label" for="category">Select Category</label>
                                                        <select class="form-select" id="categoryGlobal_i" name="cat_id" required>
                                                            <option value="" selected disabled>Select Category</option>
                                                            {{--global variable created in AppServiceProvider--}}
                                                            @foreach($global_categories as $category)
                                                                <option value="{{ $category->cat_id }}">{{ $category->cat_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <!-- Sub-Category Dropdown -->
                                                    <div class="mb-3">
                                                        <label class="form-label" for="subcategoryGlobal_i">Select Sub Category</label>
                                                        <select class="form-select" id="subcategoryGlobal_i" name="sub_cat_id" required>
                                                            <option value="" selected disabled>Select Sub Category</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="floatingTextarea2">Note</label>
                                                        <textarea class="form-control" name="note" placeholder="Note" id="floatingTextarea2" style="height: 100px"></textarea>
                                                    </div>
                                                </div>
                                            </div><!--end row-->
                                        </div><!--end modal-body-->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-soft-primary btn-sm">Add Income</button>
                                            <button type="button" class="btn btn-soft-secondary btn-sm"
                                                    data-bs-dismiss="modal">Close
                                            </button>
                                        </div><!--end modal-footer-->
                                    </form>

                                </div><!--end modal-content-->
                            </div><!--end modal-dialog-->
                        </div>
                        {{--modal ends--}}
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


<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/metismenu.min.js') }}"></script>
<script src="{{ asset('assets/js/waves.js') }}"></script>
<script src="{{ asset('assets/js/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#categoryGlobal').on('change', function () {
            var categoryId = $(this).val();

            $('#subcategoryGlobal').html('<option value="">Loading...</option>');

            $.ajax({
                url: "{{ route('get.subcategories') }}",
                type: "GET",
                data: {
                    category_id: categoryId
                },
                success: function (data) {
                    $('#subcategoryGlobal').empty();
                    $('#subcategoryGlobal').append('<option value="" disabled selected>Select Sub Category</option>');
                    $.each(data, function (index, subcategory) {
                        $('#subcategoryGlobal').append('<option value="' + subcategory.sub_cat_id + '">' + subcategory.sub_cat_name + '</option>');
                    });
                },
                error: function () {
                    $('#subcategoryGlobal').html('<option value="">Failed to load</option>');
                }
            });
        });
    });

    /*for income*/
    $(document).ready(function () {
        $('#categoryGlobal_i').on('change', function () {
            var categoryId = $(this).val();

            $('#subcategoryGlobal_i').html('<option value="">Loading...</option>');

            $.ajax({
                url: "{{ route('get.subcategories') }}",
                type: "GET",
                data: {
                    category_id: categoryId
                },
                success: function (data) {
                    $('#subcategoryGlobal_i').empty();
                    $('#subcategoryGlobal_i').append('<option value="" disabled selected>Select Sub Category</option>');
                    $.each(data, function (index, subcategory) {
                        $('#subcategoryGlobal_i').append('<option value="' + subcategory.sub_cat_id + '">' + subcategory.sub_cat_name + '</option>');
                    });
                },
                error: function () {
                    $('#subcategoryGlobal_i').html('<option value="">Failed to load</option>');
                }
            });
        });
    });
</script>
</body>
</html>

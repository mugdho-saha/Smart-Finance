@extends('layouts.theme')

@section('content')

    <div class="page-content">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row">
                            <div class="col">
                                <h4 class="page-title">Reports</h4>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div><!--end row-->
            <!-- end page title end breadcrumb -->

<div class="row">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-lg-12">
        <a class="btn btn-outline-primary btn-round" href="{{route('dailyReport')}}" target="_blank">Daily Report</a>
    </div>
    <div class="col-6 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Datewise Report</h4>
                </div><!--end card-header-->
                <div class="card-body">
                    <form action="{{route('monthlyReport')}}" method="POST" target="_blank">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="exampleInputEmail1">From Date</label>
                            <input type="date" class="form-control" name="from_date" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleInputEmail1">To Date</label>
                            <input type="date" class="form-control" name="to_date" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Generate Report</button>
                    </form>
                </div><!--end card-body-->
            </div>
    </div>
</div>

        </div><!-- container -->

    </div>
@endsection

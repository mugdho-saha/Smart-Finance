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
                                <h4 class="page-title">Category</h4>
                            </div><!--end col-->

                        </div><!--end row-->
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Category List</h4>
                                    </div><!--end card-header-->
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped mb-0">
                                                <thead>
                                                <tr>
                                                    <th>Sl No</th>
                                                    <th>Category Name</th>
                                                    <th>Assigned User</th>
                                                    <th class="text-end">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i = ($categories->currentPage() - 1) * $categories->perPage() + 1;
                                                @endphp

                                                @foreach($categories as $category)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $category->cat_name }}</td>
                                                        <td>{{ $category->user->name }}</td>
                                                        <td class="text-end">
                                                            <a href="#"><i
                                                                    class="las la-pen text-secondary font-16"></i></a>
                                                            <a href="#"><i
                                                                    class="las la-trash-alt text-secondary font-16"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table><!--end /table-->
                                            <div class="mt-2 d-flex align-items-end justify-content-end">
                                                {{ $categories->links() }}
                                            </div>
                                        </div><!--end /tableresponsive-->
                                    </div><!--end card-body-->
                                </div>
                            </div>
                        </div>
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div><!--end row-->
            <!-- end page title end breadcrumb -->


        </div><!-- container -->

    </div>

@endsection

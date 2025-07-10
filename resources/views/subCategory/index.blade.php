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
                                <h4 class="page-title">Sub-Category</h4>
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
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Sub-Category</h4>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <form action="{{route('subcategory.store')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="exampleInputEmail1">Sub-Category Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                           placeholder="Enter sub-category name" name="sub_cat_name" autocomplete="off"
                                           required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlSelect1">Select Category</label>
                                    <select class="form-select" id="exampleFormControlSelect1" name="category_id"
                                            required>
                                        <option value="" selected disabled>Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->cat_id}}">{{$category->cat_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div><!--end card-body-->
                    </div>
                </div>
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Sub-Category List</h4>
                        </div><!--end card-header-->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Sub-Category Name</th>
                                        <th>Category Name</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i = ($subcategories->currentPage() - 1) * $subcategories->perPage() + 1;
                                    @endphp

                                    @foreach($subcategories as $subcategory)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $subcategory->sub_cat_name }}</td>
                                            <td>{{ $subcategory->category->cat_name }}</td>
                                            <td class="text-end">
                                                <a href="{{route('subcategory.edit',$subcategory->slug)}}"><i
                                                        class="las la-pen text-warning font-16"></i></a>
                                                <form action="{{ route('subcategory.destroy', $subcategory->sub_cat_id) }}"
                                                      method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-link text-danger p-0"
                                                            onclick="return confirm('Delete {{ addslashes($subcategory->sub_cat_name) }} permanently?')">
                                                        <i class="las la-trash-alt text-danger font-16"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table><!--end /table-->
                                <div class="mt-2 d-flex align-items-end justify-content-end">
                                    {{ $subcategories->links() }}
                                </div>
                            </div><!--end /tableresponsive-->
                        </div><!--end card-body-->
                    </div>
                </div>
            </div>


        </div><!-- container -->

    </div>

@endsection

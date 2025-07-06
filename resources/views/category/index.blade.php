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
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Add Category</h4>
                                    </div><!--end card-header-->
                                    <div class="card-body">
                                        <form action="{{route('category.store')}}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label" for="exampleInputEmail1">Category Name</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter category name" name="cat_name" autocomplete="off" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="exampleFormControlSelect1">Assigned Admin</label>
                                                <select class="form-select" id="exampleFormControlSelect1" name="user_id" required>
                                                    <option value="" selected disabled>Select Admin</option>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
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
                                                            <a href="{{route('category.edit',$category->slug)}}"><i class="las la-pen text-warning font-16"></i></a>
                                                            <form action="{{ route('category.destroy', $category->cat_id) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                        class="btn btn-link text-danger p-0"
                                                                        onclick="return confirm('Delete {{ addslashes($category->cat_name) }} permanently?')">
                                                                    <i class="las la-trash-alt text-danger font-16"></i>
                                                                </button>
                                                            </form>
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
        </div><!-- container -->
    </div>
@endsection

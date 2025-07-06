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
                                <h4 class="page-title">Update Category</h4>
                            </div><!--end col-->
                        </div><!--end row-->

                        <div class="row mt-3">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Update Category</h4>
                                    </div><!--end card-header-->
                                    <div class="card-body">
                                        <form action="{{route('category.update', $category->cat_id)}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label class="form-label" for="exampleInputEmail1">Category Name</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter category name" value="{{$category->cat_name}}" name="cat_name" autocomplete="off" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="exampleFormControlSelect1">Assigned Admin</label>
                                                <select class="form-select" id="exampleFormControlSelect1" name="user_id" required>
                                                    <option value="" selected disabled>Select Admin</option>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}" {{ $user->id == $category->user_id ? 'selected' : '' }}>
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
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

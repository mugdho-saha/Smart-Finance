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
                            <h4 class="page-title">Update Sub-Category</h4>
                        </div><!--end col-->
                    </div><!--end row-->

                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Update Sub-Category</h4>
                                </div><!--end card-header-->
                                <div class="card-body">
                                    <form action="{{route('subcategory.update', $subcategory->sub_cat_id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label class="form-label" for="exampleInputEmail1">Sub-Category Name</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter sub-category name" value="{{$subcategory->sub_cat_name}}" name="sub_cat_name" autocomplete="off" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="exampleFormControlSelect1">Select Category</label>
                                            <select class="form-select" id="exampleFormControlSelect1" name="cat_id" required>
                                                <option value="" disabled>Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->cat_id }}" {{ $category->id == $subcategory->category_id ? 'selected' : '' }}>
                                                        {{ $category->cat_name }}
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

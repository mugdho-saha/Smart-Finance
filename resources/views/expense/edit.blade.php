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
                                <h4 class="page-title">Expense</h4>
                            </div><!--end col-->
                        </div><!--end row-->
                        <div class="row mt-3">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Update Expense</h4>
                                    </div><!--end card-header-->
                                    <div class="card-body">
                                        <form action="{{route('expense.update',$expense->expense_id)}}" method="POST">
                                            @method('put')
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label" for="exampleInputEmail1">Amount</label>
                                                <input type="number" class="form-control" id="exampleInputEmail1"
                                                       placeholder="Amount" name="amount" value="{{$expense->amount}}" autocomplete="off"
                                                       required>
                                            </div>
                                            <!-- Category Dropdown -->
                                            <div class="mb-3">
                                                <label class="form-label" for="category">Select Category</label>
                                                <select class="form-select" id="category" name="cat_id" required>
                                                    <option value="{{$expense->cat_id}}" selected>{{$expense->category->cat_name}}</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->cat_id }}">{{ $category->cat_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Sub-Category Dropdown -->
                                            <div class="mb-3">
                                                <label class="form-label" for="subcategory">Select Sub Category</label>
                                                <select class="form-select" id="subcategory" name="sub_cat_id" required>
                                                    <option value="{{$expense->sub_cat_id}}" selected>{{$expense->subCategory->sub_cat_name}}</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="floatingTextarea2">Note</label>
                                                <textarea class="form-control" name="note" placeholder="Note" id="floatingTextarea2" style="height: 100px">{{$expense->note}}</textarea>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
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

    <!-- AJAX Script -->
    <script>
        $(document).ready(function () {
            $('#category').on('change', function () {
                var categoryId = $(this).val();

                $('#subcategory').html('<option value="">Loading...</option>');

                $.ajax({
                    url: "{{ route('get.subcategories') }}",
                    type: "GET",
                    data: {
                        category_id: categoryId
                    },
                    success: function (data) {
                        $('#subcategory').empty();
                        $('#subcategory').append('<option value="" disabled selected>Select Sub Category</option>');
                        $.each(data, function (index, subcategory) {
                            $('#subcategory').append('<option value="' + subcategory.sub_cat_id + '">' + subcategory.sub_cat_name + '</option>');
                        });
                    },
                    error: function () {
                        $('#subcategory').html('<option value="">Failed to load</option>');
                    }
                });
            });
        });
    </script>
@endsection

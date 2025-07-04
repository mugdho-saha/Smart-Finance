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
                                <h4 class="page-title">Profile</h4>
                            </div><!--end col-->

                        </div><!--end row-->
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div>
            <!--end row-->
            <div class="row">
                <div class="col-sm-12">
                    @include('profile.partials.update-profile-information-form')
                </div>
                <div class="col-sm-12">
                    @include('profile.partials.update-password-form')
                </div>
                <div class="col-sm-12">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            <!-- end page title end breadcrumb -->


        </div><!-- container -->

    </div>
@endsection


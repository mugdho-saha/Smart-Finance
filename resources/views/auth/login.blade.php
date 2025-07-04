@extends('layouts.theme-guest')


@section('login')

<form class="form-horizontal auth-form" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group mb-2">
        <label class="form-label" for="email">Email</label>
        <div class="input-group">
            <input id="email" type="email" class="form-control" name="email" :value="old('email')" placeholder="Enter email" autofocus required>
        </div>
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div class="form-group mb-2">
        <label class="form-label" for="password">Password</label>
        <div class="input-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
        </div>
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div><!--end form-group-->

    <div class="form-group row my-3">
        <div class="col-sm-6">
            <div class="custom-control custom-switch switch-success">
                <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                <label class="form-label text-muted" for="customSwitchSuccess">Remember me</label>
            </div>
        </div>
        <div class="col-sm-6 text-end">
            <a class='text-muted font-13' href='{{ route('password.request') }}'><i class="dripicons-lock"></i> Forgot password?</a>
        </div><!--end col-->
    </div><!--end form-group-->

    <div class="form-group mb-0 row">
        <div class="col-12">
            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In <i class="fas fa-sign-in-alt ms-1"></i></button>
        </div><!--end col-->
    </div> <!--end form-group-->
</form>

@endsection


@section('signup')
    <form class="form-horizontal auth-form" action="{{ route('register') }}" method="POST">
        @csrf
        <!-- Name -->
        <div class="form-group mb-2">
            <label class="form-label" for="name">Name</label>
            <div class="input-group">
                <input type="text" class="form-control" name="name" :value="old('name')" required autofocus id="username" placeholder="Enter username">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        </div>


        <div class="form-group mb-2">
            <label class="form-label" for="email">Email</label>
            <div class="input-group">
                <input type="email" class="form-control" name="email" id="email" :value="old('email')" placeholder="Enter Email" required>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div><!--end form-group-->


        <div class="form-group mb-2">
            <label class="form-label" for="password">Password</label>
            <div class="input-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div><!--end form-group-->

        <div class="form-group mb-2">
            <label class="form-label" for="password_confirmation">Confirm Password</label>
            <div class="input-group">
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Enter Confirm Password" required>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div><!--end form-group-->


        <div class="form-group mb-2">
            <label class="form-label" for="phone">Mobile Number</label>
            <div class="input-group">
                <input type="text" class="form-control" name="phone" id="phone" :value="old('phone')" placeholder="Enter Mobile Number" required>
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
        </div><!--end form-group-->


        <div class="form-group mb-0 row">
            <div class="col-12">
                <button class="btn btn-primary w-100 waves-effect waves-light" type="Submit">Register <i class="fas fa-sign-in-alt ms-1"></i></button>
            </div><!--end col-->
        </div> <!--end form-group-->
    </form><!--end form-->
@endsection

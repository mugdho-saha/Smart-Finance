<div class="card">
    @if (session('status') === 'password-updated')
        <div class="m-3 alert alert-outline-success b-round alert-dismissible fade show" role="alert">
            <strong>Success!</strong>Password updated successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card-header">
        <h4 class="card-title">Update Password</h4>
        <p class="text-muted mb-0">Ensure your account is using a long, random password to stay secure.</p>
    </div><!--end card-header-->
    <div class="card-body">
        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')
            <div class="mb-3">
                <label class="form-label" for="update_password_current_password">Current Password</label>
                <input type="password" class="form-control" id="update_password_current_password" name="current_password">
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div class="mb-3">
                <label class="form-label" for="update_password_password">New Password</label>
                <input type="password" class="form-control" id="update_password_password" name="password">
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div class="mb-3">
                <label class="form-label" for="update_password_password_confirmation">Confirm New Password</label>
                <input type="password" class="form-control" id="update_password_password_confirmation" name="password_confirmation">
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div><!--end card-body-->
</div><!--end card-->

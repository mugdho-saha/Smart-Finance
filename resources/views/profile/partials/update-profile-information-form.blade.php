<div class="card">
    @if (session('status') === 'profile-updated')
    <div class="m-3 alert alert-outline-success b-round alert-dismissible fade show" role="alert">
        <strong>Success!</strong>Information updated successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card-header">
        <h4 class="card-title">Profile Information</h4>
        <p class="text-muted mb-0">Update your account's profile information and email address.</p>
    </div><!--end card-header-->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <div class="card-body">
        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label class="form-label" for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
                <x-input-error class="mt-2" :messages="$errors->get('name')"/>
            </div>
            <div class="mb-3">
                <label class="form-label" for="phone">Mobile Number</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                <x-input-error class="mt-2" :messages="$errors->get('phone')"/>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div><!--end card-body-->
</div><!--end card-->

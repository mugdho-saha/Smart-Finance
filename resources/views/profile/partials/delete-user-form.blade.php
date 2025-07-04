<div class="card">
    @if (session('status') === 'profile-updated')
        <div class="m-3 alert alert-outline-success b-round alert-dismissible fade show" role="alert">
            <strong>Success!</strong>Information updated successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card-header">
        <h4 class="card-title">Delete Account</h4>
        <p class="text-muted mb-0">Once your account is deleted, all of its resources and data will be permanently
            deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
    </div><!--end card-header-->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <div class="card-body">
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
            {{ __('Delete Account') }}
        </button>

        <!-- Modal -->
        <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="deleteAccountLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAccountLabel">{{ __('Delete Account') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p>{{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}</p>
                        <p>{{ __('Please enter your password to confirm you would like to permanently delete your account.') }}</p>

                        <!-- Form -->
                        <form method="POST" action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('delete')

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password') }}">
                                @if ($errors->userDeletion->get('password'))
                                    <div class="text-danger mt-1">
                                        {{ $errors->userDeletion->first('password') }}
                                    </div>
                                @endif
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                <button type="submit" class="btn btn-danger">{{ __('Delete Account') }}</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>

    </div><!--end card-body-->
</div><!--end card-->

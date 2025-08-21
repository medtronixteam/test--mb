@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3>Reset Password</h3>
    </div>
    <div class="card-body">
                             @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('reset.password') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="new-password">New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="new-password" name="new_password">
                                        <span class="input-group-text">
                                            <i class="fa fa-eye-slash" id="toggle-new-password"
                                                onclick="togglePassword('new-password', 'toggle-new-password')"></i>
                                        </span>
                                    </div>
                                    @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label for="confirm-password">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="confirm-password"
                                            name="confirm_password">
                                        <span class="input-group-text">
                                            <i class="fa fa-eye-slash" id="toggle-confirm-password"
                                                onclick="togglePassword('confirm-password', 'toggle-confirm-password')"></i>
                                        </span>
                                    </div>
                                    @error('confirm_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary mt-3" >Reset Password</button>
                            </form>
                        </div>
</div>
 <script>
    function togglePassword(id, iconId) {
        let input = document.getElementById(id);
        let icon = document.getElementById(iconId);
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        }
    }
</script>
@endsection

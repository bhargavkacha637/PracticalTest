@extends('layouts.guest')

@section('content')
<div class="card-body login-card-body">
    <p class="login-box-msg">{{ __('Register') }}</p>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <div class="input-group mb-3">
            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="{{ __('First Name') }}" autocomplete="first_name" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
            @error('first_name')
            <span class="error invalid-feedback">
                {{ $message }}
            </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="{{ __('Last Name') }}" autocomplete="last_name" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
            @error('last_name')
            <span class="error invalid-feedback">
                {{ $message }}
            </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}" autocomplete="email">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
            <span class="error invalid-feedback">
                {{ $message }}
            </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" autocomplete="new-password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
            <span class="error invalid-feedback">
                {{ $message }}
            </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="{{ __('Confirm Password') }}" autocomplete="new-password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" placeholder="{{ __('DOB') }}" autocomplete="dob" autofocus>
            @error('dob')
            <span class="error invalid-feedback">
                {{ $message }}
            </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" placeholder="{{ __('Image') }}" autocomplete="image" autofocus>
            @error('image')
            <span class="error invalid-feedback">
                {{ $message }}
            </span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <select name="role" class="form-control @error('role') is-invalid @enderror">
                <option value="1">Admin</option>
                <option value="0">User</option>
            </select>
            @error('role')
            <span class="error invalid-feedback">
                {{ $message }}
            </span>
            @enderror
        </div>

        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
            </div>
        </div>
    </form>
</div>
@endsection
@section("scripts")
<script>
    $(function() {
        $(".datepicker").datepicker();
    });
</script>
@endsection
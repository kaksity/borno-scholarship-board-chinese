@extends('web.admins.auth-layout')

@section('main-content')
<div class="text-center mt-4">
    <h1 class="h2">Welcome back!</h1>
    <p class="lead">
        Sign in to your account to continue
    </p>
</div>
<div class="m-sm-3">
    @if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{ session('error') }}
    </div>
    @endif
    <form action="{{ route('admin.authentication.login.process-login-form') }}" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" />
            @error('email')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
            @error('password')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div>
            <div class="form-check align-items-center">
                <input id="customControlInline" type="checkbox" class="form-check-input" name="remember_me" value="yes" checked>
                <label class="form-check-label text-small" for="customControlInline">Remember me</label>
            </div>
        </div>
        <div class="d-grid gap-2 mt-3">
            <input type="submit" class="btn btn-primary" value="Log In" />
        </div>
    </form>
</div>
<div class="text-center mb-3">
    Forgot your password? <a href="{{ route('admin.reset-password.display-reset-password-form') }}">Reset Password</a>
</div>

@endsection

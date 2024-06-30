@extends('web.admins.auth-layout')

@section('main-content')
<div class="text-center mt-4">
    <h1 class="h2">Welcome back!</h1>
    <p class="lead">
        Sign in to your account to continue
    </p>
</div>
<div class="m-sm-3">
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <form action="{{ route('admin.reset-password.process-reset-password-form') }}" method="post">
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
        <div class="d-grid gap-2 mt-3">
            <input type="submit" class="btn btn-primary" value="Reset Password" />
        </div>
    </form>
</div>
<div class="text-center mb-3">
    Already have an account? <a href="{{ route('admin.authentication.login.display-login-form') }}">Log In</a>
</div>


@endsection

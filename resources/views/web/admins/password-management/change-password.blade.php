@extends('web.admins.main-layout')
@section('main-content')
<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Change Password</h5>
            </div>
            <div class="card-body">
                @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ session('error') }}
                </div>
                @endif
                <form method="post" action="{{ route('admin.change-password.process-change-password-form') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Old Password</label>
                        <input class="form-control form-control-lg" type="password" name="old_password" placeholder="Enter old Password" />
                        @error('old_password')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input class="form-control form-control-lg" type="password" name="new_password" placeholder="Enter your new password" />
                        @error('new_password')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input class="form-control form-control-lg" type="password" name="new_password_confirmation" placeholder="Enter your password confirmation" />
                        @error('password_confirmation')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="change_password" value="Change Password">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

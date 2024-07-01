@extends('web.applicants.auth-layout')

@section('main-content')
<div class="text-center mt-4">
    <h1 class="h2">Welcome!</h1>
    <p class="lead">
        Create a new application account to continue
    </p>
</div>
<div class="m-sm-3">
    @if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{ session('error') }}
    </div>
    @endif
    <form action="{{ route('applicant.register.process-register-form') }}" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label">Surname</label>
            <input class="form-control form-control-lg" type="text" name="surname" placeholder="Enter your surname" value="{{ old('surname') }}" />
            @error('surname')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Other names</label>
            <input class="form-control form-control-lg" type="text" name="other_names" placeholder="Enter your other names" value="{{ old('other_names') }}" />
            @error('other_names')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input class="form-control form-control-lg" type="text" name="email" placeholder="Enter your email address" value="{{ old('email') }}" />
            @error('email')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <input class="form-control form-control-lg" type="text" name="phone_number" placeholder="Enter your phone number" value="{{ old('phone_number') }}" />
            @error('phone_number')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Course Of Study</label>
            <select class="form-select mb-3" name="course_of_study_id">
                @foreach ($courseOfStudies as $courseOfStudy)
                <option
                    value="{{ $courseOfStudy->id }}"
                    @if($courseOfStudy->id == old('course_of_study_id'))
                        selected
                    @endif
                >
                    {{ $courseOfStudy->name }}
                </option>
                @endforeach
            </select>
            @error('course_of_study_id')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Year of WAEC</label>
            <select class="form-select mb-3" name="year">
                @foreach ($years as $year)
                <option
                    value="{{ $year }}"
                    @if($year == old('year'))
                        selected
                    @endif
                >
                    {{ $year }}
                </option>
                @endforeach
            </select>
            @error('year')
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
        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input class="form-control form-control-lg" type="password" name="password_confirmation" placeholder="Enter your password confirmation" />
            @error('password_confirmation')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="d-grid gap-2 mt-3">
            <input type="submit" class="btn btn-primary" value="Create Account" />
        </div>
    </form>
</div>
<div class="text-center mb-3">
    Already have an account? <a href="{{ route('applicant.authentication.login.display-login-form') }}">Log In</a>
</div>
@endsection

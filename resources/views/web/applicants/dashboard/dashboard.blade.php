@extends('web.applicants.main-layout')

@section('main-content')
@if(is_null($applicant->verified_at))
<div class="card">
    <div class="card-boyd">
        <div class="p-4">
            <div>
                <h4>Account Verification</h4>
            </div>
            <div>
                @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                <p class="text">Your account has not yet been verified, Kindly check your mail for the verification mail, Or rather you can request a new account verification mail</p>
                <form action="{{ route('applicant.account-verification.process-request-account-verification-mail') }}" method="post">
                    @csrf
                    <input type="submit" class="btn btn-primary" value="Request Verification Mail">
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@if($applicant->status == 'Submitted')
<div class="card">
    <div class="card-body">
        <div class="p-4">
            <div>
                <h4>Application Status Update @if($applicant->has_passed_grade_point == true) <i class="align-middle text-success" data-feather="check"></i> @else <i class="align-middle text-danger" data-feather="x"></i> @endif </h4>
            </div>
            @if($applicant->has_passed_grade_point == true)
            <div>
                <p class="text">We are pleased to inform you that your application has met the criteria with {{ $applicant->earned_grades }} points and you have moved to the next stage of the scholarship selection process.</p>
                <p class="text">Thank you for your outstanding effort and interest. We will be in touch with further details soon.</p>
            </div>
            @else
            <div>
                <p class="text">
                    We regret to inform you that your application, which earned {{ $applicant->earned_grades }} points, did not meet the required criteria points. Thank you for your interest and effort. We encourage you to apply again in the future.
                </p>
            </div>
            @endif
        </div>
    </div>
</div>
@else
    <div class="card">
        <div class="card-body">
            <div class="p-4">
                You are yet to submit your application kindly complete all the form and provide all the need information. You can start <a href="{{ route('applicant.profile-management.display-profile-form') }}">here</a>
            </div>
        </div>
    </div>
@endif

@endsection

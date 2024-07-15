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

@if ($applicant->status != 'Submitted' && !is_null($applicant->verified_at))
<div class="card">
    <div class="card-body">
        <div class="p-4">
            You are yet to submit your application kindly complete all the form and provide all the need information. You can start <a href="{{ route('applicant.profile-management.display-profile-form') }}">here</a>
        </div>
    </div>
</div>
@endif

@if($applicant->status == 'Submitted')
<div class="card">
    <div class="card-body">
        <div class="p-4">
            <div>
                <h4>Application Status Update</h4>
            </div>
            <div>
                <p class="text">We are pleased to inform you that your application has submitted.</p>
                <p class="text">Thank you for your interest. We will be in touch with further details soon.</p>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

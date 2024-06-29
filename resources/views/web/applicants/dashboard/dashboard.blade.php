@extends('web.applicants.main-layout')

@section('main-content')
@if($applicant->status == 'Submitted')
<div class="card">
    <div class="card-boyd">
        <div class="p-4">
            <div>
                <h4>Application Status Update</h4>
            </div>
            @if($applicant->has_passed_grade_point == true)
            <div>
                <p class="text">We are pleased to inform you that your application has met the criteria with {{ $applicant->earned_grades }} points and you have moved to the next stage of the scholarship selection process.</p>
                <p class="text">Thank you for your outstanding effort and interest. We will be in touch with further details soon.</p>
            </div>
            @else
            <div>
                <p class="text">
                    We regret to inform you that your application, which earned {{ $applicant->earned_grades }} points, did not meet the required criteria of {{ $gradePointLimit }} points. Thank you for your interest and effort. We encourage you to apply again in the future.
                </p>
            </div>
            @endif
        </div>
    </div>
</div>
@endif
@endsection

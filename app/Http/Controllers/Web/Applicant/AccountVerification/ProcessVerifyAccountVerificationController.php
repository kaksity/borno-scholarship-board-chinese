<?php

namespace App\Http\Controllers\Web\Applicant\AccountVerification;

use App\Actions\ApplicantActions;
use App\Actions\ApplicantBioDataActions;
use App\Actions\ApplicantVerificationActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Applicant\Onboarding\ProcessApplicantRegistrationRequest;
use App\Mail\AccountVerificationMail;
use App\Mail\ApplicantAccountVerificationMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ProcessVerifyAccountVerificationController extends Controller
{
    public function __construct(
        private ApplicantActions $applicantActions,
        private ApplicantVerificationActions $applicantVerificationActions,
        private ApplicantBioDataActions $applicantBioDataActions,
    ) {
    }

    public function handle($id)
    {
        $getDistinctApplicantVerificationOptions = [
            'token' => $id,
            'purpose' => 'account-verification',
        ];

        $applicantVerification =  $this->applicantVerificationActions->getDistinctApplicantVerificationRecord(
            $getDistinctApplicantVerificationOptions
        );

        if (is_null($applicantVerification)) {
            return redirect()->route('applicant.dashboard.display-dashboard-view');
        }

        $applicant = $this->applicantActions->getApplicantById($applicantVerification->applicant_id);

        if ($applicantVerification->expires_at < Carbon::now()) {
            return redirect()->route('applicant.applicant-verification.index')->with(
                'pending',
                "Your Verification has expired. Click on the Resend Verification Mail to get a fresh email and then check your email({$applicant->email}) for the verification link(Check your spam if you did not see the mail)"
            );
        }

        DB::transaction(function () use ($applicant) {
            $deleteApplicantAuthenticationVerificationOptions = [
                'applicant_id' => $applicant->id,
                'purpose' => 'account-verification'
            ];

            $this->applicantVerificationActions->deleteApplicantAuthenticationVerificationRecords(
                $deleteApplicantAuthenticationVerificationOptions
            );

            $this->applicantActions->updateApplicantRecord([
                'verified_at' => Carbon::now()
            ], $applicant->id);
        });

        auth('applicant')->login($applicant);

        return redirect()->route('applicant.profile-management.display-profile-form');
    }
}

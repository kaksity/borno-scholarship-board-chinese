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

class ProcessRequestAccountVerificationController extends Controller
{
    public function __construct(
        private ApplicantActions $applicantActions,
        private ApplicantVerificationActions $applicantVerificationActions,
        private ApplicantBioDataActions $applicantBioDataActions,
    ) {
    }

    public function handle()
    {
        $loggedInApplicant = auth('applicant')->user();

        if (!is_null($loggedInApplicant->verified_at)) {
            return redirect()->route('applicant.profile-management.display-profile-form');
        }

        DB::transaction(function () use ($loggedInApplicant) {
            $deleteApplicantAuthenticationVerificationOptions = [
                'applicant_id' => $loggedInApplicant->id,
                'purpose' => 'account-verification'
            ];
            $this->applicantVerificationActions->deleteApplicantAuthenticationVerificationRecords($deleteApplicantAuthenticationVerificationOptions);
            $token = Str::random(200);

            $this->applicantVerificationActions->createApplicantVerificationRecord([
                'applicant_id' => $loggedInApplicant->id,
                'expires_at' => Carbon::now()->addMinutes(30),
                'token' => $token
            ]);

            $mail = new ApplicantAccountVerificationMail([
                'surname' => $loggedInApplicant->surname,
                'other_names' => $loggedInApplicant->other_names,
                'token' => $token
            ]);

            Mail::to($loggedInApplicant)->later(now()->addSeconds(5), $mail);

        });

        return back()->with('success', "Account verification mail has been sent to your mail $loggedInApplicant->email");
    }
}

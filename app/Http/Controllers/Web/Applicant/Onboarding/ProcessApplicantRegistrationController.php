<?php

namespace App\Http\Controllers\Web\Applicant\Onboarding;

use App\Actions\ApplicantActions;
use App\Actions\ApplicantVerificationActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Applicant\Onboarding\ProcessApplicantRegistrationRequest;
use App\Mail\AccountVerificationMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ProcessApplicantRegistrationController extends Controller
{
    public function __construct(
        private ApplicantActions $applicantActions,
        private ApplicantVerificationActions $applicantVerificationActions,
    )
    {}

    public function handle(ProcessApplicantRegistrationRequest $request)
    {
        $createdApplicantOptions = $request->safe()->merge([
            'password' => Hash::make($request->password),
        ])->all();

        $existingApplicant = $this->applicantActions->getApplicantByEmailAddress($request->email);

        if (is_null($existingApplicant) == false) {
            session('error', 'Applicant with this email already created');
            return back();
        }

        $this->applicantActions->createApplicantRecord($createdApplicantOptions);

        auth('applicant')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        $loggedInApplicant = auth('applicant')->user();

        $token = Str::random(200);

        $this->applicantVerificationActions->createApplicantVerificationRecord([
            'applicant_id' => $loggedInApplicant->id,
            'expires_at' => Carbon::now()->addMinutes(30),
            'token' => $token
        ]);

        // Mail::to($loggedInApplicant)->later(now()->addSeconds(5), new AccountVerificationMail([
        //     'surname' => $loggedInApplicant->surname,
        //     'other_names' => $loggedInApplicant->other_names,
        //     'token' => $token
        // ]));

        return redirect()->route('applicant.profile-management.display-profile-form');
    }
}

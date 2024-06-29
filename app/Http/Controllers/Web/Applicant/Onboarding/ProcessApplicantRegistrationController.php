<?php

namespace App\Http\Controllers\Web\Applicant\Onboarding;

use App\Actions\ApplicantActions;
use App\Actions\ApplicantBioDataActions;
use App\Actions\ApplicantVerificationActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Applicant\Onboarding\ProcessApplicantRegistrationRequest;
use App\Mail\AccountVerificationMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ProcessApplicantRegistrationController extends Controller
{
    public function __construct(
        private ApplicantActions $applicantActions,
        private ApplicantVerificationActions $applicantVerificationActions,
        private ApplicantBioDataActions $applicantBioDataActions,
    ) {
    }

    public function handle(ProcessApplicantRegistrationRequest $request)
    {
        $applicant = $this->applicantActions->getApplicantByEmailAddress(
            $request->email
        );

        if (!is_null($applicant)) {
            return back()->with('status', 'Applicant record already exists');
        }

        $createApplicantOptions = $request->safe()->merge([
            'year' => Carbon::now()->year,
            'password' => Hash::make($request->password),
            'status' => 'Applying'
        ])->all();


        DB::transaction(function () use ($createApplicantOptions) {

            $applicant =  $this->applicantActions->createApplicantRecord(
                $createApplicantOptions
            );

            $this->applicantBioDataActions->createApplicantBioDataRecord([
                'applicant_id' => $applicant->id
            ]);

            return $applicant;
        });

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

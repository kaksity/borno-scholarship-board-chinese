<?php

namespace App\Http\Controllers\Web\Applicant\PasswordManagement\ResetPassword;

use App\Actions\ApplicantActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Applicant\PasswordManagement\ResetPassword\ResetPasswordRequest;
use App\Mail\ApplicantResetAccountPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ProcessResetPasswordController extends Controller
{
    public function __construct(
        private ApplicantActions $applicantActions
    )
    {}

    public function handle(ResetPasswordRequest $request)
    {
        $applicant = $this->applicantActions->getApplicantByEmailAddress(
            $request->email
        );

        if (is_null($applicant)) {
            return back()->with(
                'success',
                'An email containing password reset instructions has been sent to the applicant'
            );
        }

        $password = Str::random(8);

        $this->applicantActions->updateApplicantRecord([
            'password' => Hash::make($password)
        ], $applicant->id);

        // Mail::to($applicant)->later(now()->addSeconds(5), new ApplicantResetAccountPasswordMail([
        //     'surname' => $applicant->surname,
        //     'other_names' => $applicant->other_names,
        //     'password' => $password
        // ]));

        return back()->with(
            'success',
            'An email containing password reset instructions has been sent to the applicant'
        );
    }
}

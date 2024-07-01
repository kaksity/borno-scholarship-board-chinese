<?php

namespace App\Http\Controllers\Web\Applicant\PasswordManagement\ChangePassword;

use App\Actions\ApplicantActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Applicant\PasswordManagement\ChangePassword\ChangePasswordRequest;
use App\Services\Interfaces\ApplicantServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProcessChangePasswordController extends Controller
{
    public function __construct(
        private ApplicantActions $applicantActions
    )
    {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handle(ChangePasswordRequest $request)
    {
        $loggedInApplicant = auth('applicant')->user();

        if (!Hash::check($request->old_password, $loggedInApplicant->password)) {
            return back()->with('error', 'Old Password was not correct');
        }

        $this->applicantActions->updateApplicantRecord([
            'password' => Hash::make($request->new_password)
        ], $loggedInApplicant->id);

        return back()->with('success', 'Password was changed successfully');
    }
}

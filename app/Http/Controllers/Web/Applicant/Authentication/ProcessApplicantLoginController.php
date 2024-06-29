<?php

namespace App\Http\Controllers\Web\Applicant\Authentication;

use App\Actions\ApplicantActions;
use App\Http\Requests\Web\Applicant\Authentication\ProcessApplicantLoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProcessApplicantLoginController extends Controller
{
    public function __construct(
        private ApplicantActions $applicantActions,
    )
    {}
    public function handle(ProcessApplicantLoginRequest $request)
    {

        $existingApplicant = $this->applicantActions->getApplicantByEmailAddress($request->email);

        if (is_null($existingApplicant)) {
            session('error', 'Invalid login credential. Kindly create an account');
            return back();
        }

        $isPasswordValid = Hash::check($request->password, $existingApplicant->password);

        if ($isPasswordValid == false) {
            session('error', 'Invalid login credential. Kindly create an account');
            return back();
        }

        auth('applicant')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->remember_me);

        // Redirect the user to the login endpoints
        return redirect()->route('applicant.profile-management.display-profile-form');
    }
}

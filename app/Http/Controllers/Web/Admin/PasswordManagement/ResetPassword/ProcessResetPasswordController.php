<?php

namespace App\Http\Controllers\Web\Admin\PasswordManagement\ResetPassword;

use App\Actions\AdminActions;
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
        private AdminActions $adminActions
    )
    {}

    public function handle(ResetPasswordRequest $request)
    {
        $admin = $this->adminActions->getAdminByEmailAddress(
            $request->email
        );

        if (is_null($admin)) {
            return back()->with(
                'success',
                'An email containing password reset instructions has been sent to the applicant'
            );
        }

        $password = Str::random(8);

        $this->adminActions->updateAdminRecord([
            'password' => Hash::make($password)
        ], $admin->id);

        Mail::to($admin)->later(now()->addSeconds(5), new ApplicantResetAccountPasswordMail([
            'surname' => $admin->surname,
            'other_names' => $admin->other_names,
            'password' => $password
        ]));

        return back()->with(
            'success',
            'An email containing password reset instructions has been sent to the admin'
        );
    }
}

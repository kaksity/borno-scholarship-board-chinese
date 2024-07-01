<?php

namespace App\Http\Controllers\Web\Applicant\PasswordManagement\ChangePassword;

use App\Http\Controllers\Controller;

class DisplayChangePasswordViewController extends Controller
{
    public function handle()
    {
        return view('web.applicants.password-management.change-password');
    }
}

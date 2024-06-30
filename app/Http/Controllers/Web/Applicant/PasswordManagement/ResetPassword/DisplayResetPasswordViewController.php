<?php

namespace App\Http\Controllers\Web\Applicant\PasswordManagement\ResetPassword;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisplayResetPasswordViewController extends Controller
{
    public function handle()
    {
        return view('web.applicants.password-management.change-password');
    }
}

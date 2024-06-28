<?php

namespace App\Http\Controllers\Web\Applicant\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProcessApplicantLogoutController extends Controller
{
    public function handle()
    {
        auth('applicant')->logout();

        return redirect()->route('applicant.authentication.login.display-login-form');
    }
}

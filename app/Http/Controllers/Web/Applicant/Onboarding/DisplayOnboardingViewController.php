<?php

namespace App\Http\Controllers\Web\Applicant\Onboarding;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisplayOnboardingViewController extends Controller
{
    public function handle()
    {
        return view('web.applicants.onboarding.registration');
    }
}

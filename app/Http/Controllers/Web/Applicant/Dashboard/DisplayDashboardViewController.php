<?php

namespace App\Http\Controllers\Web\Applicant\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisplayDashboardViewController extends Controller
{
    public function handle()
    {
        $loggedInApplicant = auth('applicant')->user();

        dd($loggedInApplicant);
        return view('web.applicants.dashboard.dashboard', [
            'applicant' => $loggedInApplicant
        ]);
    }
}

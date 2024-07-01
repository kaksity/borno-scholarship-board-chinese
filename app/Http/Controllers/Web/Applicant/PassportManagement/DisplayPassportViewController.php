<?php

namespace App\Http\Controllers\Web\Applicant\PassportManagement;

use App\Actions\ApplicantActions;
use App\Actions\ApplicantBioDataActions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisplayPassportViewController extends Controller
{
    public function __construct(
        private ApplicantBioDataActions $applicantBioDataActions,
    ) {
    }

    public function handle()
    {
        $loggedInApplicant = auth('applicant')->user();

        $applicantBioData = $this->applicantBioDataActions->getApplicantBioDataByApplicantId(
            $loggedInApplicant->id
        );

        return view('web.applicants.passport-management.view-passport', [
            'applicant' => $loggedInApplicant,
            'applicantBioData' => $applicantBioData
        ]);
    }
}

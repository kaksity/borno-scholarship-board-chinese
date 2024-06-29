<?php

namespace App\Http\Controllers\Web\Applicant\ProfileManagement;

use App\Actions\ApplicantActions;
use App\Actions\LgaActions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisplayProfileViewController extends Controller
{
    public function __construct(
        private LgaActions $lgaActions,
        private ApplicantActions $applicantActions,
    )
    {}

    public function handle()
    {
        $loggedInApplicant = auth('applicant')->user();

        $lgas = $this->lgaActions->listLgas();

        $relationships =[

        ];
        $applicant = $this->applicantActions->getApplicantById($loggedInApplicant->id, $relationships);

        return view('web.applicants.profile-management.view-profile',[
            'applicant' => $applicant,
            'lgas' => $lgas
        ]);
    }
}

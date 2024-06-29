<?php

namespace App\Http\Controllers\Web\Applicant\ProfileManagement;

use App\Actions\LgaActions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisplayProfileViewController extends Controller
{
    public function __construct(
        private LgaActions $lgaActions
    )
    {}

    public function handle()
    {
        $loggedInApplicant = auth('applicant')->user();
        $lgas = $this->lgaActions->listLgas();

        return view('web.applicants.profile-management.view-profile',[
            'applicant' => $loggedInApplicant,
            'lgas' => $lgas
        ]);
    }
}

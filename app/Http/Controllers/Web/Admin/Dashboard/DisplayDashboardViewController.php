<?php

namespace App\Http\Controllers\Web\Admin\Dashboard;

use App\Actions\ApplicantActions;
use App\Actions\ApplicantBioDataActions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisplayDashboardViewController extends Controller
{
    public function __construct(
        private ApplicantBioDataActions $applicantBioDataActions,
        private ApplicantActions $applicantActions,
    )
    {}

    public function handle()
    {
        $genderMetrics = $this->applicantBioDataActions->getApplicantsGenderMetrics();
        $applicationStatusMetrics = $this->applicantActions->getApplicantsApplicationStatusMetrics();
        $courseOfStudyMetrics = $this->applicantActions->getApplicantsCourseOfStudyMetrics();

        return view('web.admins.dashboard.dashboard', [
            'genderMetrics' => $genderMetrics,
            'applicationStatusMetrics' => $applicationStatusMetrics,
            'courseOfStudyMetrics' => $courseOfStudyMetrics,
        ]);
    }
}

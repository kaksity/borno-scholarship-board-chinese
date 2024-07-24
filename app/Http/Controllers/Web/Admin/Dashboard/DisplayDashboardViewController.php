<?php

namespace App\Http\Controllers\Web\Admin\Dashboard;

use App\Actions\ApplicantActions;
use App\Actions\ApplicantBioDataActions;
use App\Actions\ApplicantPaymentDataActions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisplayDashboardViewController extends Controller
{
    public function __construct(
        private ApplicantBioDataActions $applicantBioDataActions,
        private ApplicantActions $applicantActions,
        private ApplicantPaymentDataActions $applicantPaymentDataActions,
    )
    {}

    public function handle()
    {
        $genderMetrics = $this->applicantBioDataActions->getApplicantsGenderMetrics();
        $applicationStatusMetrics = $this->applicantActions->getApplicantsApplicationStatusMetrics();
        $courseOfStudyMetrics = $this->applicantActions->getApplicantsCourseOfStudyMetrics();
        $paymentSummaries = $this->applicantPaymentDataActions->getApplicantPaymentDataSummary();

        return view('web.admins.dashboard.dashboard', [
            'genderMetrics' => $genderMetrics,
            'applicationStatusMetrics' => $applicationStatusMetrics,
            'courseOfStudyMetrics' => $courseOfStudyMetrics,
            'paymentSummaries' => $paymentSummaries
        ]);
    }
}

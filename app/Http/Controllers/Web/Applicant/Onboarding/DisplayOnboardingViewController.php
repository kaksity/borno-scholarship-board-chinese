<?php

namespace App\Http\Controllers\Web\Applicant\Onboarding;

use App\Actions\CourseOfStudyActions;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DisplayOnboardingViewController extends Controller
{
    public function __construct(
        private CourseOfStudyActions $courseOfStudyActions
    )
    {}

    public function handle()
    {

        $courseOfStudies = $this->courseOfStudyActions->listCourseOfStudies();

        $startYear = env('START_WAEC_YEAR');
        $currentYear = Carbon::now()->year;

        $years = [];
        for ($year = $startYear; $year <= $currentYear; $year++) {
            $years[] = $year;
        }

        return view('web.applicants.onboarding.registration', [
            'years' => $years,
            'courseOfStudies' => $courseOfStudies
        ]);
    }
}

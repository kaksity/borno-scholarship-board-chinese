<?php

namespace App\Http\Controllers\Web\Admin\Reports;

use App\Actions\ApplicantActions;
use App\Actions\CourseOfStudyActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\ApplicationManagement\ListApplicationsRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DisplayReportsViewController extends Controller
{
    public function __construct(
        private CourseOfStudyActions $courseOfStudyActions,
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

        return view('web.admins.reports.generate-report', [
            'years' => $years,
            'courseOfStudies' => $courseOfStudies
        ]);
    }
}

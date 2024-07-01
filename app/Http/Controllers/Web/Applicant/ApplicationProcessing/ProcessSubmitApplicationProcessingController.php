<?php

namespace App\Http\Controllers\Web\Applicant\ApplicationProcessing;

use App\Actions\ApplicantActions;
use App\Actions\ApplicantSubjectDataActions;
use App\Actions\CourseOfStudyActions;
use App\Actions\SubjectActions;
use App\Http\Controllers\Controller;

class ProcessSubmitApplicationProcessingController extends Controller
{
    public function __construct(
        private ApplicantSubjectDataActions $applicantSubjectDataActions,
        private ApplicantActions $applicantActions,
        private SubjectActions $subjectActions,
        private CourseOfStudyActions $courseOfStudyActions,
    )
    {}

    public function handle()
    {
        $loggedInApplicant = auth('applicant')->user();

        if($loggedInApplicant->status == 'Submitted') {
            return back()->with('error', 'Application has been submitted');
        }

        $getApplicantSubjectFilterOptions = [
            'applicant_id' => $loggedInApplicant->id
        ];

        $relationships = [
            'subject',
            'grade'
        ];

        $subjects = $this->subjectActions->listSubjects();

        $applicantSubjectData = $this->applicantSubjectDataActions->getApplicantSubjectDataFiltered(
            $getApplicantSubjectFilterOptions,
            $relationships
        );

        if(count($subjects) != count($applicantSubjectData)) {
            return back()->with('error', 'All subject grades have to be provided');
        }

        $totalPointsEarned = 0;

        foreach($applicantSubjectData as $applicantSubject) {
            $totalPointsEarned = $totalPointsEarned + $applicantSubject->grade->grade;
        }

        $totalPointsEarned = $totalPointsEarned / count($subjects);

        $courseOfStudy = $this->courseOfStudyActions->getCourseOfStudyById($loggedInApplicant->course_of_study_id);

        $gradePointLimit = $courseOfStudy->minimum_points;

        $updateApplicantRecordOptions['status'] = 'Submitted';
        $updateApplicantRecordOptions['has_passed_grade_point'] = $totalPointsEarned > $gradePointLimit ? true : false;
        $updateApplicantRecordOptions['earned_grades'] = $totalPointsEarned;
        $updateApplicantRecordOptions['tracking_code'] = generateRandomString();

        $this->applicantActions->updateApplicantRecord(
            $updateApplicantRecordOptions
        , $loggedInApplicant->id);

        return redirect()->route('applicant.dashboard.display-dashboard-view');
    }
}

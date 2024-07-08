<?php

namespace App\Http\Controllers\Web\Applicant\ApplicationProcessing;

use App\Actions\ApplicantSubjectDataActions;
use App\Actions\CourseOfStudyActions;
use App\Actions\GradeActions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisplayApplicationProcessingViewController extends Controller
{
    public function __construct(
        private CourseOfStudyActions $courseOfStudyActions,
        private ApplicantSubjectDataActions $applicantSubjectDataActions,
        private GradeActions $gradeActions,
    )
    {}

    public function handle()
    {
        $loggedInApplicant = auth('applicant')->user();

        $relationships = [
            'subjects'
        ];

        $courseOfStudy =$this->courseOfStudyActions->getCourseOfStudyById($loggedInApplicant->course_of_study_id);

        $grades = $this->gradeActions->listGrades();
        $subjects = $courseOfStudy->subjects;

        $relationships = [
            'subject',
            'grade'
        ];

        $getApplicantSubjectFilterOptions = [
            'applicant_id' => $loggedInApplicant->id
        ];

        $applicantSubjectData = $this->applicantSubjectDataActions->getApplicantSubjectDataFiltered(
            $getApplicantSubjectFilterOptions,
            $relationships
        );

        return view('web.applicants.application-processing.application-processing',[
            'subjects' => $subjects,
            'grades' => $grades,
            'applicantSubjectData' => $applicantSubjectData,
            'applicant' => $loggedInApplicant
        ]);
    }
}

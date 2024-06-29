<?php

namespace App\Http\Controllers\Web\Applicant\ApplicationProcessing;

use App\Actions\ApplicantSubjectDataActions;
use App\Actions\GradeActions;
use App\Actions\SubjectActions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisplayApplicationProcessingViewController extends Controller
{
    public function __construct(
        private SubjectActions $subjectActions,
        private ApplicantSubjectDataActions $applicantSubjectDataActions,
        private GradeActions $gradeActions,
    )
    {}

    public function handle()
    {
        $grades = $this->gradeActions->listGrades();
        $subjects = $this->subjectActions->listSubjects();
        $relationships = [
            'subject',
            'grade'
        ];

        $loggedInApplicant = auth('applicant')->user();

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

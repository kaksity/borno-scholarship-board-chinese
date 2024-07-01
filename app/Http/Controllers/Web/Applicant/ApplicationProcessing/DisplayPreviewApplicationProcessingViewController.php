<?php

namespace App\Http\Controllers\Web\Applicant\ApplicationProcessing;

use App\Actions\ApplicantActions;
use App\Actions\ApplicantSubjectDataActions;
use App\Actions\GradeActions;
use App\Actions\SubjectActions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisplayPreviewApplicationProcessingViewController extends Controller
{
    public function __construct(
        private ApplicantActions $applicantActions
    )
    {}

    public function handle()
    {

        $loggedInApplicant = auth('applicant')->user();

        $relationships = [
            'applicantBioData.lga',
            'applicantUploadedDocumentData',
            'applicantSubjectData.subject',
            'applicantSubjectData.grade',
        ];

        $applicant = $this->applicantActions->getApplicantById(
            $loggedInApplicant->id,
            $relationships
        );

        return view('web.applicants.application-processing.preview-application-processing',[
            'applicant' => $applicant
        ]);
    }
}

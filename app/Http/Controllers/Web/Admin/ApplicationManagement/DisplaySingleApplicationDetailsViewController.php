<?php

namespace App\Http\Controllers\Web\Admin\ApplicationManagement;

use App\Actions\ApplicantActions;
use App\Actions\ApplicantSubjectDataActions;
use App\Actions\GradeActions;
use App\Actions\SubjectActions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisplaySingleApplicationDetailsViewController extends Controller
{
    public function __construct(
        private ApplicantActions $applicantActions
    )
    {}

    public function handle($applicantId)
    {

        $relationships = [
            'applicantBioData.lga',
            'applicantUploadedDocumentData',
            'applicantSubjectData.subject',
            'applicantSubjectData.grade',
        ];

        $applicant = $this->applicantActions->getApplicantById(
            $applicantId,
            $relationships
        );

        if(is_null($applicant)) {
            return redirect()->back();
        }

        return view('web.admins.application-management.single-application-details',[
            'applicant' => $applicant
        ]);
    }
}

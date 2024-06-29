<?php

namespace App\Http\Controllers\Web\Applicant\UploadManagement;

use App\Actions\ApplicantUploadedDocumentDataActions;
use App\Actions\DocumentTypeActions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisplayUploadDocumentViewController extends Controller
{
    public function __construct(
        private DocumentTypeActions $documentTypeActions,
        private ApplicantUploadedDocumentDataActions $applicantUploadedDocumentDataActions
    )
    {}

    public function handle()
    {
        $documentTypes = $this->documentTypeActions->listDocumentTypes();

        $loggedInApplicant = auth('applicant')->user();

        $getApplicationQualificationFilterOptions = [
            'applicant_id' => $loggedInApplicant->id
        ];

        $relationships = ['documentType'];

        $applicantUploadDocuments = $this->applicantUploadedDocumentDataActions->getApplicantUploadedDocumentDataFiltered(
            $getApplicationQualificationFilterOptions,
            $relationships
        );

        $data = [
            'documentTypes' => $documentTypes,
            'applicantUploadDocuments' => $applicantUploadDocuments,
            'applicant' => $loggedInApplicant
        ];

        return view('web.applicants.upload-management.uploaded-document-data')->with($data);
    }
}

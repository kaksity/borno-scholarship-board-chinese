<?php

namespace App\Http\Controllers\Web\Applicant\UploadManagement;

use App\Actions\ApplicantUploadedDocumentDataActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Applicant\UploadManagement\ProcessUploadDocumentRequest;
use Illuminate\Http\Request;

class ProcessDeleteUploadedDocumentController extends Controller
{
    public function __construct(
        private ApplicantUploadedDocumentDataActions $applicantUploadedDocumentDataActions
    )
    {}

    public function handle($id)
    {
        $this->applicantUploadedDocumentDataActions->deleteApplicantUploadedDocumentDataRecord($id);
        return back()->with('success', 'Applicant Uploaded Document record was deleted successfully');
    }
}

<?php

namespace App\Http\Controllers\Web\Applicant\ApplicationProcessing;

use App\Actions\ApplicantSubjectDataActions;
use App\Actions\ApplicantUploadedDocumentDataActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Applicant\UploadManagement\ProcessUploadDocumentRequest;
use App\Models\ApplicantSubjectData;
use Illuminate\Http\Request;

class ProcessDeleteApplicationProcessingController extends Controller
{
    public function __construct(
        private ApplicantSubjectDataActions $applicantSubjectDataActions,
    )
    {}

    public function handle($id)
    {
        $this->applicantSubjectDataActions->deleteApplicantSubjectDataRecord($id);

        return back()->with('status', 'Applicant subject record was deleted successfully');
    }
}

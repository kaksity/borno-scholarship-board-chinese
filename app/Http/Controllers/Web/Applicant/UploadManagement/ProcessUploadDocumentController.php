<?php

namespace App\Http\Controllers\Web\Applicant\UploadManagement;

use App\Actions\ApplicantUploadedDocumentDataActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Applicant\UploadManagement\ProcessUploadDocumentRequest;
use Illuminate\Http\Request;

class ProcessUploadDocumentController extends Controller
{
    public function __construct(
        private ApplicantUploadedDocumentDataActions $applicantUploadedDocumentDataActions
    )
    {}

    public function handle(ProcessUploadDocumentRequest $request)
    {
        $loggedInApplicant = auth('applicant')->user();

        $extension = $request->file->getClientOriginalExtension();
        $fileNameToStore = time().uniqid().'.'.$extension;

        $path = $request->file->storeAs('public/documents', $fileNameToStore);


        $createUploadedOptions = $request->safe()->merge([
            'applicant_id' => $loggedInApplicant->id,
            'file_path' => $path
        ])->except('file');

        $this->applicantUploadedDocumentDataActions->createApplicantUploadedDocumentDataRecord(
            $createUploadedOptions
        );

        return back()->with('status', 'Applicant Uploaded Document record was created successfully');
    }
}

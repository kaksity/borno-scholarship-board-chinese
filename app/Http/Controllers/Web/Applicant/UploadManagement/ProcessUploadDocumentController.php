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


        $existingUploadedDocument = $this->applicantUploadedDocumentDataActions->getDistinctApplicantUploadedDocument([
            'applicant_id' => $loggedInApplicant->id,
            'document_type_id' => $request->document_type_id
        ]);

        if (!is_null($existingUploadedDocument)) {
            return back()->with('error', 'Applicant document already uploaded');
        }

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

        return back()->with('success', 'Applicant Uploaded Document record was created successfully');
    }
}

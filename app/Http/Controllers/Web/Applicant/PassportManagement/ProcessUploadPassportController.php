<?php

namespace App\Http\Controllers\Web\Applicant\PassportManagement;

use App\Actions\ApplicantBioDataActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Applicant\PassportManagement\ProcessUploadPassportRequest;

class ProcessUploadPassportController extends Controller
{
    public function __construct(
        private ApplicantBioDataActions $applicantBioDataActions,
    ) {
    }

    public function handle(ProcessUploadPassportRequest $request)
    {
        $loggedInApplicant = auth('applicant')->user();


        $extension = $request->passport->getClientOriginalExtension();
        $fileNameToStore = time() . uniqid() . '.' . $extension;

        $path = $request->passport->storeAs('public/passports', $fileNameToStore);

        $updateApplicantBioDataRequestOptions =  [
            'passport_path' => $path,
        ];

        $applicantBioData = $this->applicantBioDataActions->getApplicantBioDataByApplicantId(
            $loggedInApplicant->id
        );

        $this->applicantBioDataActions->updateApplicantBioDataRecord(
            $updateApplicantBioDataRequestOptions,
            $applicantBioData->id
        );

        return redirect()->route('applicant.upload-management.display-upload-document-form');
    }
}

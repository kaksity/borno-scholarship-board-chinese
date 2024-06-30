<?php

namespace App\Actions;

use App\Models\ApplicantVerification;

class ApplicantVerificationActions
{
    public function __construct(
        private ApplicantVerification $applicantVerification
    )
    {}

    public function createApplicantVerificationRecord($data)
    {
        return $this->applicantVerification->create($data);
    }

    public function getDistinctApplicantVerificationRecord($getDistinctApplicantVerificationOptions)
    {
        $purpose = $getDistinctApplicantVerificationOptions['purpose'];
        $token = $getDistinctApplicantVerificationOptions['token'];

        return $this->applicantVerification->where([
            'purpose' =>$purpose,
            'token' => $token
        ])->first();
    }
    public function deleteApplicantAuthenticationVerificationRecords($deleteApplicantAuthenticationVerificationOptions)
    {
        $applicantId = $deleteApplicantAuthenticationVerificationOptions['applicant_id'];
        $purpose = $deleteApplicantAuthenticationVerificationOptions['purpose'];

        $this->applicantVerification->where([
            'applicant_id' => $applicantId,
            'purpose' =>$purpose
        ])->delete();
    }
}

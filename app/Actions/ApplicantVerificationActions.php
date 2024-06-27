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
}

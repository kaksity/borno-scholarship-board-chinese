<?php

namespace App\Models;

class ApplicantVerification extends AbstractModel
{
    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }
}

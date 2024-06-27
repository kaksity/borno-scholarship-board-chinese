<?php

namespace App\Models;

class ApplicantPaymentData extends AbstractModel
{
    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }
}

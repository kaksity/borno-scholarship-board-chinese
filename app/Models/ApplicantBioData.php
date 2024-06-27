<?php

namespace App\Models;

class ApplicantBioData extends AbstractModel
{
    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }

    public function lga()
    {
        return $this->belongsTo(Lga::class, 'lga_id');
    }
}


<?php

namespace App\Models;

class Applicant extends AbstractAuthenticatableModel
{
    protected $guard = 'applicant';

    protected $casts = [
        'has_passed_grade_point' => 'boolean'
    ];

    public function applicantBioData()
    {
        return $this->hasOne(ApplicantBioData::class, 'applicant_id');
    }

    public function applicantRefereeData()
    {
        return $this->hasMany(ApplicantRefereeData::class, 'applicant_id');
    }

    public function applicantUploadedDocumentData()
    {
        return $this->hasMany(ApplicantUploadedDocumentData::class, 'applicant_id');
    }

    public function applicantSubjectData()
    {
        return $this->hasMany(ApplicantSubjectData::class, 'applicant_id');
    }
}


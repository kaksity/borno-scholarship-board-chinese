<?php

namespace App\Actions;

use App\Models\Applicant;
use App\Repositories\Interfaces\ApplicantRepositoryInterface;

class ApplicantActions
{
    public function __construct(
        private Applicant $applicant
    )
    {}

    public function createApplicantRecord($data)
    {
        return $this->applicant->create($data);
    }

    public function updateApplicantRecord($data, $id)
    {
        $this->applicant->where([
            'id' => $id
        ])->update($data);
    }
    public function getApplicantById($id, $relationships = [])
    {
        return $this->applicant->with($relationships)->where([
            'id' => $id
        ])->first();
    }

    public function getApplicantsFiltered($getApplicantsFilterOptions, $relationships = [])
    {
        $programme = $getApplicantsFilterOptions['programme'] ?? null;
        $perPage = $getApplicantsFilterOptions['per_page'] ?? 100;

        return $this->applicant->with($relationships)->when($programme, function($model, $programme) {
            $model->where([
                'programme' => $programme
            ]);
        })->latest()->paginate($perPage);
    }

    public function getApplicantByEmailAddress($emailAddress, $relationships = [])
    {
        return $this->applicant->with($relationships)->where([
            'email' => $emailAddress
        ])->first();
    }
}

<?php

namespace App\Actions;

use App\Models\ApplicantRefereeData;
use App\Repositories\Interfaces\ApplicantRefereeDataRepositoryInterface;

class ApplicantRefereeDataActions
{
    public function __construct(
        private ApplicantRefereeData $applicantRefereeData
    )
    {}

    public function createApplicantRefereeDataRecord($data)
    {
        return $this->applicantRefereeData->create($data);
    }

    public function deleteApplicantRefereeDataRecord($id)
    {
        $this->applicantRefereeData->where([
            'id' => $id
        ])->delete();
    }
    public function getApplicantRefereeDataById($id, $relationships = [])
    {
        return $this->applicantRefereeData->with($relationships)->where([
            'id' => $id
        ])->first();
    }

    public function updateApplicantRefereeDataRecord($data, $id)
    {
        $this->applicantRefereeData->where([
            'id' => $id
        ])->update($data);
    }

    public function getApplicantRefereeDataFiltered(
        $getApplicantRefereeFilterOptions,
        $relationships = []
    )
    {
        $applicantId = $getApplicantRefereeFilterOptions['applicant_id'] ?? null;

        return $this->applicantRefereeData->with(
            $relationships
        )->when($applicantId, function($model, $applicantId) {
            $model->where([
                'applicant_id' => $applicantId
            ]);
        })->get();
    }
}

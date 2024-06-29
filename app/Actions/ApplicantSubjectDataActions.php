<?php

namespace App\Actions;

use App\Models\ApplicantSubjectData;

class ApplicantSubjectDataActions
{
    public function __construct(
        private ApplicantSubjectData $applicantSubjectData
    )
    {}

    public function createApplicantSubjectDataRecord($data)
    {
        return $this->applicantSubjectData->create($data);
    }

    public function deleteApplicantSubjectDataRecord($id)
    {
        $this->applicantSubjectData->where([
            'id' => $id
        ])->delete();
    }
    public function getDistinctApplicantSubjectRecord($getDistinctApplicantSubjectOptions, $relationships = [])
    {
        $applicantId = $getDistinctApplicantSubjectOptions['applicant_id'];
        $subjectId = $getDistinctApplicantSubjectOptions['subject_id'];

        return $this->applicantSubjectData->with($relationships)->where([
            'applicant_id' => $applicantId,
            'subject_id' => $subjectId
        ])->first();
    }

    public function getApplicantSubjectDataById($id, $relationships = [])
    {
        return $this->applicantSubjectData->with($relationships)->where([
            'id' => $id
        ])->first();
    }

    public function updateApplicantSubjectDataRecord($data, $id)
    {
        $this->applicantSubjectData->where([
            'id' => $id
        ])->update($data);
    }

    public function getApplicantSubjectDataFiltered(
        $getApplicantSubjectFilterOptions,
        $relationships = []
    )
    {
        $applicantId = $getApplicantSubjectFilterOptions['applicant_id'] ?? null;
        $subjectId = $getApplicantSubjectFilterOptions['subject'] ?? null;

        return $this->applicantSubjectData->with(
            $relationships
        )->when($applicantId, function($model, $applicantId) {
            $model->where([
                'applicant_id' => $applicantId
            ]);
        })->when($subjectId, function ($model, $subjectId) {
            $model->where([
                'subject' => $subjectId
            ]);
        })->get();
    }
}

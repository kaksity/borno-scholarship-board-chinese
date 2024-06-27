<?php

namespace App\Actions;

use App\Models\ApplicantUploadedDocumentData;
use App\Repositories\Interfaces\ApplicantUploadedDocumentDataRepositoryInterface;

class ApplicantUploadedDocumentDataActions
{
    public function __construct(
        private ApplicantUploadedDocumentData $applicantUploadedDocumentData
    )
    {}

    public function createApplicantUploadedDocumentDataRecord($data)
    {
        return $this->applicantUploadedDocumentData->create($data);
    }

    public function deleteApplicantUploadedDocumentDataRecord($id)
    {
        $this->applicantUploadedDocumentData->where([
            'id' => $id
        ])->delete();
    }
    public function getApplicantUploadedDocumentDataById($id, $relationships = [])
    {
        return $this->applicantUploadedDocumentData->with($relationships)->where([
            'id' => $id
        ])->first();
    }

    public function updateApplicantUploadedDocumentDataRecord($data, $id)
    {
        $this->applicantUploadedDocumentData->where([
            'id' => $id
        ])->update($data);
    }

    public function getApplicantUploadedDocumentDataFiltered(
        $getApplicantUploadedDocumentFilterOptions,
        $relationships = []
    )
    {
        $applicantId = $getApplicantUploadedDocumentFilterOptions['applicant_id'] ?? null;
        $documentTypeId = $getApplicantUploadedDocumentFilterOptions['document_type_id'] ?? null;

        return $this->applicantUploadedDocumentData->with(
            $relationships
        )->when($applicantId, function($model, $applicantId) {
            $model->where([
                'applicant_id' => $applicantId
            ]);
        })->when($documentTypeId, function ($model, $documentTypeId) {
            $model->where([
                'UploadedDocument_type_id' => $documentTypeId
            ]);
        })->get();
    }
}

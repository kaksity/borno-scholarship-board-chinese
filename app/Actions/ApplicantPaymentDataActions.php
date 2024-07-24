<?php

namespace App\Actions;

use App\Models\ApplicantPaymentData;
use App\Repositories\Interfaces\ApplicantPaymentDataRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ApplicantPaymentDataActions
{
    public function __construct(
        private ApplicantPaymentData $applicantPaymentData
    )
    {}

    public function createApplicantPaymentDataRecord($data)
    {
        return $this->applicantPaymentData->create($data);
    }

    public function deleteApplicantPaymentDataRecord($id)
    {
        $this->applicantPaymentData->where([
            'id' => $id
        ])->delete();
    }
    public function getApplicantPaymentDataById($id, $relationships = [])
    {
        return $this->applicantPaymentData->with($relationships)->where([
            'id' => $id
        ])->first();
    }

    public function updateApplicantPaymentDataRecord($data, $id)
    {
        $this->applicantPaymentData->where([
            'id' => $id
        ])->update($data);
    }

    public function getApplicantPaymentDataFiltered($getApplicantPaymentFilterOptions, $relationships = [])
    {
        $applicantId = $getApplicantPaymentFilterOptions['applicant_id'] ?? null;
        $status = $getApplicantPaymentFilterOptions['status'] ?? null;

        return $this->applicantPaymentData->with(
            $relationships
        )->when($applicantId, function($model, $applicantId) {
            $model->where([
                'applicant_id' => $applicantId
            ]);
        })->when($status, function($model, $status) {
            $model->where([
                'status' => $status
            ]);
        })->latest()->get();
    }
    public function getApplicantPaymentDataByReference($reference, $relationships = [])
    {
        return $this->applicantPaymentData->with($relationships)->where([
            'rrr' => $reference
        ])->first();
    }
    public function getApplicantPaymentDataSummary()
    {
        $paymentSummaries = ApplicantPaymentData::select('status', DB::raw('SUM(amount) as total_amount'))
        ->groupBy('status')
        ->get();

        $result = [];
        foreach ($paymentSummaries as $paymentSummary) {
            $result[$paymentSummary->status] = number_format(
                $paymentSummary->total_amount
            );
        }

        return $result;
    }
}

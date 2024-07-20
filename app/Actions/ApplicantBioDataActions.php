<?php

namespace App\Actions;

use App\Models\ApplicantBioData;
use App\Repositories\Interfaces\ApplicantBioDataRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ApplicantBioDataActions
{
    public function __construct(
        private ApplicantBioData $applicantBioData
    ) {
    }

    public function createApplicantBioDataRecord($data)
    {
        return $this->applicantBioData->create($data);
    }

    public function getApplicantBioDataById($id, $relationships = [])
    {
        return $this->applicantBioData->with($relationships)->where([
            'id' => $id
        ])->first();
    }

    public function getApplicantBioDataByApplicantId($applicantId, $relationships = [])
    {
        return $this->applicantBioData->with($relationships)->where([
            'applicant_id' => $applicantId
        ])->first();
    }

    public function updateApplicantBioDataRecord($data, $id)
    {
        return $this->applicantBioData->where([
            'id' => $id
        ])->update($data);
    }

    public function getApplicantsGenderMetrics()
    {
        $genderCounts = $this->applicantBioData->select(
            DB::raw('COALESCE(gender, "Incomplete Profile") as gender'),
            DB::raw('count(*) as total')
        )
            ->groupBy('gender')
            ->get()
            ->keyBy('gender');

        $genders = ['Male', 'Female', 'Incomplete Profile'];

        $result = [];
        foreach ($genders as $gender) {
            $count = $genderCounts->get($gender, (object)['gender' => $gender, 'total' => 0]);
            $result[$gender] = $count?->total ?? 0;
        }
        return $result;
    }
}

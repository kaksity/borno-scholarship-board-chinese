<?php

namespace App\Actions;

use App\Models\Applicant;
use App\Repositories\Interfaces\ApplicantRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ApplicantActions
{
    public function __construct(
        private Applicant $applicant
    ) {
    }

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

        return $this->applicant->with($relationships)->when($programme, function ($model, $programme) {
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

    public function getApplicantsApplicationStatusMetrics()
    {
        $applicationStatusCounts = $this->applicant->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get()
            ->keyBy('status');

        $statuses = ['Applying', 'Submitted'];

        $result = [];
        foreach ($statuses as $status) {
            $count = $applicationStatusCounts->get($status, (object)['status' => $status, 'total' => 0]);
            $result[$status] = $count?->total ?? 0;
        }
        return $result;
    }

    public function getApplicantsCourseOfStudyMetrics()
    {
        $courseCounts = $this->applicant->select(
            'course_of_studies.name as course_name',
            DB::raw('count(*) as total')
        )
            ->join('course_of_studies', 'applicants.course_of_study_id', '=', 'course_of_studies.id')
            ->groupBy('course_of_studies.name')
            ->get()
            ->keyBy('course_name');

        // Initialize the final result array
        $result = [];
        foreach ($courseCounts as $courseName => $courseCount) {
            $result[$courseName] = $courseCount->total;
        }
        return $result;
    }
}

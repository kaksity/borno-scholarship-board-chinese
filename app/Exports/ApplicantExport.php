<?php

namespace App\Exports;

use App\Actions\ApplicantActions;
use App\Models\Applicant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ApplicantExport implements FromCollection, WithHeadings, WithMapping
{
    private ApplicantActions $applicantActions;

    public function __construct(public $getApplicantsReportFilterOptions)
    {
        $this->applicantActions = app()->make(ApplicantActions::class);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Surname',
            'Other Names',
            'Email Address',
            'Phone Number',
            'Year',
            'Status',
            'Course of Study',
            'Candidate Number',
            'Scored Points',
            'Has Passed Grade Point',
            'Date of Birth',
            'Gender',
            'Guardian Full Name',
            'NIN',
            'LGA'
        ];
    }
    public function map($applicant): array
    {
        return [
            $applicant->surname,
            $applicant->other_names,
            $applicant->email,
            $applicant->phone_number,
            $applicant->year,
            $applicant->status,
            $applicant->courseOfStudy->name,
            $applicant->candidate_number,
            $applicant->earned_grades,
            $applicant->has_passed_grade_point === true ? 'Yes' : 'No',
            $applicant->applicantBioData->date_of_birth,
            $applicant->applicantBioData->gender,
            $applicant->applicantBioData->guardian_full_name,
            $applicant->applicantBioData->nin,
            // $applicant->applicantBioData?->lga->name,
        ];
    }
    public function collection()
    {
        $relationships = [
            'applicantBioData.lga',
            'applicantUploadedDocumentData',
            'applicantSubjectData.subject',
            'applicantSubjectData.grade',
        ];

        return $this->applicantActions->getApplicantsReport(
            $this->getApplicantsReportFilterOptions,
            $relationships
        );
    }
}

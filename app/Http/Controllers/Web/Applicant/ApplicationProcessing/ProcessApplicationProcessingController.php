<?php

namespace App\Http\Controllers\Web\Applicant\ApplicationProcessing;

use App\Actions\ApplicantSubjectDataActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Applicant\ApplicationProcessing\ProcessApplicationRequest;
use Illuminate\Http\Request;

class ProcessApplicationProcessingController extends Controller
{
    public function __construct(
        private ApplicantSubjectDataActions $applicantSubjectDataActions,
    )
    {}

    public function handle(ProcessApplicationRequest $request)
    {
        $loggedInApplicant = auth('applicant')->user();

        $existingApplicantSubject = $this->applicantSubjectDataActions->getDistinctApplicantSubjectRecord([
            'applicant_id' => $loggedInApplicant->id,
            'subject_id' => $request->subject_id,
        ]);

        if(!is_null($existingApplicantSubject)) {
            return back()->with('error', 'Applicant subject already exists');
        }

        $createUploadedOptions = $request->safe()->merge([
            'applicant_id' => $loggedInApplicant->id,
        ])->all();

        $this->applicantSubjectDataActions->createApplicantSubjectDataRecord(
            $createUploadedOptions
        );

        return back()->with('success', 'Applicant subject record was created successfully');
    }
}

<?php

namespace App\Http\Controllers\Web\Applicant\ProfileManagement;

use App\Actions\ApplicantActions;
use App\Actions\ApplicantBioDataActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Applicant\ProfileManagement\ProcessUpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProcessUpdateProfileController extends Controller
{
    public function __construct(
        private ApplicantActions $applicantActions,
        private ApplicantBioDataActions $applicantBioDataActions,
    )
    {}

    public function handle(ProcessUpdateProfileRequest $request)
    {
        $loggedInApplicant = auth('applicant')->user();

        $updateApplicantBioDataRequestOptions = $request->except('_token', 'phone_number', 'candidate_number');
        $updateApplicantRequestOptions = $request->only('phone_number', 'candidate_number');

        DB::transaction(function () use (
            $updateApplicantBioDataRequestOptions,
            $updateApplicantRequestOptions,
            $loggedInApplicant
        ) {

            $applicantBioData = $this->applicantBioDataActions->getApplicantBioDataByApplicantId($loggedInApplicant->id);

            $this->applicantBioDataActions->updateApplicantBioDataRecord(
                $updateApplicantBioDataRequestOptions,
                $applicantBioData->id
            );

            $this->applicantActions->updateApplicantRecord(
                $updateApplicantRequestOptions,
                $loggedInApplicant->id
            );
        });

        return redirect()->route('applicant.passport-management.display-passport-form');
    }
}

<?php

namespace App\Http\Controllers\Web\Applicant\ProfileManagement;

use App\Actions\ApplicantActions;
use App\Actions\ApplicantBioDataActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Applicant\ProfileManagement\ProcessUpdateProfileRequest;
use Illuminate\Http\Request;

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
        return back();
    }
}

<?php

namespace App\Http\Controllers\Web\Admin\ApplicationManagement;

use App\Actions\ApplicantActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\ApplicationManagement\ListApplicationsRequest;
use Illuminate\Http\Request;

class DisplayAllApplicationsViewController extends Controller
{
    public function __construct(
        private ApplicantActions $applicantActions
    ) {
    }

    public function handle(ListApplicationsRequest $request)
    {
        $getApplicationsRequestOptions = $request->validated();

        $relationships = [
            'courseOfStudy'
        ];

        $applicants = $this->applicantActions->getApplicantsFiltered(
            $getApplicationsRequestOptions,
            $relationships
        );

        return view('web.admins.application-management.all-applications', [
            'applicants' => $applicants
        ]);
    }
}

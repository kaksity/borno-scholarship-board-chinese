<?php

namespace App\Http\Controllers\Web\Admin\ApplicationManagement;

use App\Actions\ApplicantActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\ApplicationManagement\ListApplicationsRequest;
use Illuminate\Http\Request;

class DisplayReportsViewController extends Controller
{
    public function __construct(
        private 
    )
    {}

    public function handle(ListApplicationsRequest $request)
    {
        $getApplicationsRequestOptions = $request->validated();

        $applicants = $this->applicantActions->getApplicantsFiltered(
            $getApplicationsRequestOptions
        );

        return view('web.admins.application-management.all-applications',[
            'applicants' => $applicants
        ]);
    }
}

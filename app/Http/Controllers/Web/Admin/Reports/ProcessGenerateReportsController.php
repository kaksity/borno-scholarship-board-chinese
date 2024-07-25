<?php

namespace App\Http\Controllers\Web\Admin\Reports;

use App\Actions\ApplicantActions;
use App\Exports\ApplicantExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Reports\GenerateReportRequest;
use Maatwebsite\Excel\Facades\Excel;

class ProcessGenerateReportsController extends Controller
{
    public function __construct(
        private ApplicantActions $applicantActions,
    )
    {}

    public function handle(GenerateReportRequest $request)
    {
        $getApplicantsReportFilterOptions = $request->validated();

        $fileName = generateRandomString();

        return Excel::download(new ApplicantExport($getApplicantsReportFilterOptions), "$fileName.xlsx");
    }
}

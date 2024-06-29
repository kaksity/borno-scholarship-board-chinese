<?php

namespace App\Http\Controllers\Web\Applicant\ApplicationProcessing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisplayApplicationProcessingViewController extends Controller
{
    public function handle()
    {
        return view('web.applicants.application-processing.application-processing');
    }
}

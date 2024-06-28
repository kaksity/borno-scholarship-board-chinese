<?php

namespace App\Http\Controllers\Web\Applicant\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisplayLoginViewController extends Controller
{
    public function handle()
    {
        return view('web.applicants.authentication.login');
    }
}

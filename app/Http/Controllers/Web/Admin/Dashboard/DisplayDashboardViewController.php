<?php

namespace App\Http\Controllers\Web\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisplayDashboardViewController extends Controller
{
    public function handle()
    {
        return view('web.admins.dashboard.dashboard');
    }
}

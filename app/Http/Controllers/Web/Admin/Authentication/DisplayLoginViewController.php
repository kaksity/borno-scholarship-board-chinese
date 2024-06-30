<?php

namespace App\Http\Controllers\Web\Admin\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisplayLoginViewController extends Controller
{
    public function handle()
    {
        return view('web.admins.authentication.login');
    }
}

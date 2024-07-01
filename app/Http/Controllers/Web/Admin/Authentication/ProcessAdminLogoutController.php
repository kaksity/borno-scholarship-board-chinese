<?php

namespace App\Http\Controllers\Web\Admin\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProcessAdminLogoutController extends Controller
{
    public function handle()
    {
        auth('admin')->logout();

        return redirect()->route('admin.authentication.login.display-login-form');
    }
}

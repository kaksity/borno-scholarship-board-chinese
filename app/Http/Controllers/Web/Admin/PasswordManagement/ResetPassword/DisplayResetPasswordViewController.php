<?php

namespace App\Http\Controllers\Web\Admin\PasswordManagement\ResetPassword;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisplayResetPasswordViewController extends Controller
{
    public function handle()
    {
        return view('web.admins.password-management.reset-password');
    }
}

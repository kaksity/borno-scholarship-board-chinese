<?php

namespace App\Http\Controllers\Web\Admin\PasswordManagement\ChangePassword;

use App\Http\Controllers\Controller;

class DisplayChangePasswordViewController extends Controller
{
    public function handle()
    {
        return view('web.admins.password-management.change-password');
    }
}

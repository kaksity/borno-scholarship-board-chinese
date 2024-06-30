<?php

namespace App\Http\Controllers\Web\Admin\PasswordManagement\ChangePassword;

use App\Actions\AdminActions;
use App\Actions\ApplicantActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Applicant\PasswordManagement\ChangePassword\ChangePasswordRequest;
use App\Services\Interfaces\ApplicantServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProcessChangePasswordController extends Controller
{
    public function __construct(
        private AdminActions $adminActions
    )
    {}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handle(ChangePasswordRequest $request)
    {
        $loggedInAdmin = auth('admin')->user();

        if (!Hash::check($request->old_password, $loggedInAdmin->password)) {
            return back()->with('error', 'Old Password was not correct');
        }

        $this->adminActions->updateAdminRecord([
            'password' => Hash::make($request->new_password)
        ], $loggedInAdmin->id);

        return back()->with('success', 'Password was changed successfully');
    }
}

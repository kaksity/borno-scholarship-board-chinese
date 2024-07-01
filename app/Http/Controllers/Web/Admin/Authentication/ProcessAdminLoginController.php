<?php

namespace App\Http\Controllers\Web\Admin\Authentication;

use App\Actions\AdminActions;
use App\Http\Requests\Web\Admin\Authentication\ProcessAdminLoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProcessAdminLoginController extends Controller
{
    public function __construct(
        private AdminActions $adminActions
    )
    {}
    public function handle(ProcessAdminLoginRequest $request)
    {
        $admin = $this->adminActions->getAdminByEmailAddress($request->email);

        if (is_null($admin)) {
            return back()->with('error', 'Invalid login credential. Kindly create an account');
        }

        $isPasswordValid = Hash::check($request->password, $admin->password);

        if ($isPasswordValid == false) {
            return back()->with('error', 'Invalid login credential. Kindly create an account');
        }

        auth('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->remember_me);

        // Redirect the user to the login endpoints
        return redirect()->route('admin.dashboard.display-dashboard-view');
    }
}

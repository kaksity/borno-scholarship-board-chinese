<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Middleware\Authenticate as AuthenticationMiddleware;

class CustomApplicantAuthenticationMiddleware extends AuthenticationMiddleware
{
    protected function redirectTo(Request $request)
    {
        return redirect()->route('applicant.authentication.login.display-login-form');
    }
}

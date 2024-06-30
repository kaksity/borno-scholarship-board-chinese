<?php

namespace App\Http\Middleware\Web;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnforceApplicantAccountVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $loggedInApplicant = auth('applicant')->user();
        if (is_null($loggedInApplicant->verified_at)) {
            return redirect()->route('applicant.dashboard.display-dashboard-view');
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware\Web;

use App\Actions\ApplicantPaymentDataActions;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnforceApplicationPayment
{
    public function __construct(
        private ApplicantPaymentDataActions $applicantPaymentDataActions
    )
    {}

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $loggedInApplicant = auth('applicant')->user();

        $applicationPayments = $this->applicantPaymentDataActions->getApplicantPaymentDataFiltered([
            'applicant_id' => $loggedInApplicant->id,
            'status' => 'paid'
        ]);

        $singlePayment = $applicationPayments[0] ?? null;

        if (is_null($singlePayment)) {
            return redirect()->route('applicant.application-payment.display-application-payment');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware\Web;

use App\Actions\ApplicantActions;
use App\Actions\ApplicantPaymentDataActions;
use App\InfrastructureProviders\RemitaApplicationPaymentProvider;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnforceApplicationPayment
{
    public function __construct(
        private ApplicantPaymentDataActions $applicantPaymentDataActions,
        private RemitaApplicationPaymentProvider $remitaApplicationPaymentProvider,
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
        ]);


        $singlePayment = $applicationPayments[0] ?? null;

        if (is_null($singlePayment)) {
            return redirect()->route('applicant.application-payment.display-application-payment')->with('error', 'You must complete the payment step before proceeding');
        }

        if ($singlePayment->status === 'paid') {
            return $next($request);
        }

        $response = $this->remitaApplicationPaymentProvider->verifyPayment([
            'rrr' => $singlePayment->rrr
        ]);

        if ($response->status === '00') {
            $this->applicantPaymentDataActions->updateApplicantPaymentDataRecord([
                'completed_payment_at' => Carbon::now(),
                'status' => 'paid'
            ], $singlePayment->id);

            return $next($request);
        }

        return redirect()->route(
            'applicant.application-payment.display-application-payment'
        )->with('error', 'You must complete the payment step before proceeding');
    }
}

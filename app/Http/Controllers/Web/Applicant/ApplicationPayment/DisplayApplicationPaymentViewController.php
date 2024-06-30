<?php

namespace App\Http\Controllers\Web\Applicant\ApplicationPayment;

use App\Actions\ApplicantPaymentDataActions;
use App\Http\Controllers\Controller;


class DisplayApplicationPaymentViewController extends Controller
{
    public function __construct(
        private ApplicantPaymentDataActions $applicantPaymentDataActions
    ) {
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function handle()
    {
        $loggedInApplicant = auth('applicant')->user();

        $applicantPayments = $this->applicantPaymentDataActions->getApplicantPaymentDataFiltered([
            'applicant_id' => $loggedInApplicant->id,
        ]);

        $applicantPaymentData = $applicantPayments[0] ?? null;

        $remitaPaymentInformation = null;

        return view('web.applicants.application-payment.application-payment')->with([
            'remitaPaymentInformation' => $remitaPaymentInformation,
            'applicantPaymentData' => $applicantPaymentData,
            'applicant' => $loggedInApplicant
        ]);
    }
}

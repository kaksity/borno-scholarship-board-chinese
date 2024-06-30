<?php

namespace App\Http\Controllers\Web\Applicant\ApplicationPayment;

use App\Actions\ApplicantActions;
use App\Actions\ApplicantPaymentDataActions;
use App\Actions\RemitaServiceTypeActions;
use App\Http\Controllers\Controller;
use App\InfrastructureProviders\RemitaApplicationPaymentProvider;
use Illuminate\Support\Facades\DB;

class ProcessApplicationPaymentController extends Controller
{
    public function __construct(
        private ApplicantActions $applicantActions,
        private ApplicantPaymentDataActions $applicantPaymentDataActions,
        private RemitaServiceTypeActions $remitaServiceTypeActions,
        private RemitaApplicationPaymentProvider $remitaApplicationPaymentProvider,
    ) {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handle()
    {
        $loggedInApplicant = auth('applicant')->user();
        $loggedInApplicant = $this->applicantActions->getApplicantById(
            $loggedInApplicant->id
        );

        [$remitaPaymentInformation, $applicantPaymentData] = DB::transaction(function () use ($loggedInApplicant) {

            $getRemitaServiceTypeFilterOptions['programme'] = $loggedInApplicant->programme;

            $remitaServiceTypes = $this->remitaServiceTypeActions->getRemitaServiceTypeFiltered(
                $getRemitaServiceTypeFilterOptions
            );

            $remitaServiceType = $remitaServiceTypes[0];
            $applicationFee = $remitaServiceType->amount;

            $remitaPaymentOptions = [
                'surname' => $loggedInApplicant->surname,
                'other_names' => $loggedInApplicant->other_names,
                'email_address' => $loggedInApplicant->email,
                'description' => 'Payment for Scholarship Application Fees',
                'amount' => $applicationFee,
                'service_type_id' => $remitaServiceType->value,
            ];

            $applicantPayments = $this->applicantPaymentDataActions->getApplicantPaymentDataFiltered([
                'applicant_id' => $loggedInApplicant->id,
            ]);

            $applicantPaymentData = $applicantPayments[0] ?? null;

            if (is_null($applicantPaymentData)) {

                $response = $this->remitaApplicationPaymentProvider->initiatePayment($remitaPaymentOptions);

                $applicantPaymentData = $this->applicantPaymentDataActions->createApplicantPaymentDataRecord([
                    'applicant_id' => $loggedInApplicant->id,
                    'rrr' => $response['rrr'],
                    'order_id' => $response['order_id'],
                    'amount' => $response['amount'],
                ]);
            }

            $remitaConfigurations = $this->remitaApplicationPaymentProvider->getRemitaConfigurations();

            $paymentHash = $this->remitaApplicationPaymentProvider->generateRemitaHash([
                'merchant_id' => $remitaConfigurations['merchant_id'],
                'service_type_id' => $remitaServiceType->value,
                'amount' => $applicationFee,
                'api_key' => $remitaConfigurations['api_key'],
                'order_id' => $applicantPaymentData->order_id,
            ], true);

            $apiVerificationHash = $this->remitaApplicationPaymentProvider->generateRemitaHash([
                'merchant_id' => $remitaConfigurations['merchant_id'],
                'rrr' => $applicantPaymentData->rrr,
                'api_key' => $remitaConfigurations['api_key'],
            ], false);

            $remitaPaymentInformation =  [
                'rrr' => $applicantPaymentData->rrr,
                'order_id' => $applicantPaymentData->order_id,
                'amount' => $applicationFee,
                'hash' => $paymentHash,
                'merchant_id' => $remitaConfigurations['merchant_id'],
                'public_key' => $remitaConfigurations['public_key'],
                'transaction_status' => $applicantPaymentData->status,
                'api_verification_hash' => $apiVerificationHash,
            ];

            return [$remitaPaymentInformation, $applicantPaymentData];
        });
        return view('web.applicants.application-payment.application-payment')->with([
            'remitaPaymentInformation' => $remitaPaymentInformation,
            'applicantPaymentData' => $applicantPaymentData,
            'applicant' => $loggedInApplicant
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api\WebHook\RemitaGatewayWebHookController;

use App\Actions\ApplicantPaymentDataActions;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\ApplicantPaymentDataServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RemitaGatewayWebHookController extends Controller
{
    public function __construct(
        private ApplicantPaymentDataActions $applicantPaymentDataActions,
    ) {
    }

    public function processWebHook(Request $request)
    {
        $rrr = $request[0]['rrr'];

        $applicationPayment = $this->applicantPaymentDataActions->getApplicantPaymentDataByReference(
            $rrr
        );

        if (is_null($applicationPayment)) {
            return 'Not Ok';
        }

        $this->applicantPaymentDataActions->updateApplicantPaymentDataRecord([
            'completed_payment_at' => Carbon::now(),
            'status' => 'paid'
        ], $applicationPayment->id);

        return 'Ok';
    }
}

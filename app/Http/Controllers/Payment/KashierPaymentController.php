<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KashierPaymentController extends Controller
{
    public function create(Request $request)
    {
        // ===== Static test data =====
        $amount   = '100.00';
        $orderId  = 'TEST_ORDER_001';
        $currency   = 'EGP';

        $merchantId = 'MID-41016-213';
        $paymentKey = '9f78bd9d-fd4e-45fd-a7a6-93e3998b8712';


        // Generate hash
        $hashString = $merchantId . $orderId . $amount . $currency;

        $hash = hash_hmac(
            'sha256',
            $hashString,
            $paymentKey,
            false
        );

        $paymentUrl = 'https://checkout.kashier.io/?' . http_build_query([
            'merchantId' => 'MID-41016-213',
            'orderId'    => 'TEST_' . time(),
            'amount'     => '100.00',
            'currency'   => 'EGP',
            'hash'       => $hash,
            'mode'       => 'test',
        ]);



        return response()->json([
            'status' => true,
            'url'    => $paymentUrl
        ]);
    }
}

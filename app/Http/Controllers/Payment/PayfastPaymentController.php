<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Utility\PayfastUtility;

class PayfastPaymentController extends Controller
{
    public function __construct()
    {
    }

    public function index(){
        return PayfastUtility::create_payment_form();
    }
    
    public static function payment_notify()
    {
        // Tell PayFast that this page is reachable by triggering a header 200
        header('HTTP/1.0 200 OK');
        flush();
        $pfData = $_POST;

        try {
            if (env('DEMO_MODE') != 'On') {
                $path = base_path('payfast.text');
                if (file_exists($path)) {

                    file_put_contents($path, json_encode($pfData));
                }
            }
        }
        catch (\Exception $e) {}

        if ($pfData['payment_status'] == "COMPLETE") {
            return PayfastPaymentController::payment_success($pfData['custom_str1'], $pfData);
        }

        return PayfastPaymentController::payment_incomplete();
    }

    public static function payment_return()
    {
        return ( new PaymentController )->payment_success();
    }

    public static function payment_cancel()
    {
        return PayfastPaymentController::payment_incomplete();
    }

    public static function payment_success($order_id, $responses)
    {
        $payment_details = json_encode($responses);
        return ( new PaymentController )->payment_success($payment_details);
    }

    public static function payment_incomplete()
    {
        return ( new PaymentController )->payment_failed();
    }
}

<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\ManualPaymentMethod;
use Illuminate\Http\Request;
use stdClass;

class ManualPaymentController extends Controller
{
    public function index(){
        try {
            $splittedPaymentMethod = explode('-', session('payment_method'));
            $offlinePaymentId = array_pop($splittedPaymentMethod);
            $manualPaymentMethod = ManualPaymentMethod::find((int) $offlinePaymentId);

            session()->put('manualPaymentMethod', $manualPaymentMethod);
            
            // generate payment_details here.
            if(session('payment_type') == 'wallet_payment'){
                $payment_details = 'Paid via '. $manualPaymentMethod->heading . ' for recharge';
            }else{
                $payment_details = 'Paid via '. $manualPaymentMethod->heading . '';
            }

            return ( new PaymentController )->payment_success($payment_details);
        } catch (\Throwable $th) {
            return ( new PaymentController )->payment_failed();
        }
    }
}

<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\CombinedOrder;
use App\Models\User;

class MercadopagoPaymentController extends Controller
{
    public function index()
    {
        $amount=0;
        $user = User::where('id',session('user_id'))->first();
        if(session('payment_type') == 'cart_payment'){
            $combined_order = CombinedOrder::where('code',session('order_code'))->first();
            $amount = round($combined_order->grand_total);
            $combined_order_id = $combined_order->id;
            $billname = 'Cart Payment';
            $first_name = $user->name;
            $phone = json_decode($combined_order->shipping_address)->phone ?? $user->phone;
            $email = json_decode($combined_order->shipping_address)->email ?? $user->email;

            $success_url=url('/mercadopago/payment/done');
            $fail_url=url('/mercadopago/payment/cancel');
        }
        elseif (session('payment_type') == 'wallet_payment') {
            $amount = session('amount');
            $combined_order_id = rand(10000,99999);
            $billname = 'Wallet Payment';
            $first_name = $user->name;
            $phone = $user->phone;
            $email = $user->email;
            $success_url=url('/mercadopago/payment/done');
            $fail_url=url('/mercadopago/payment/cancel');

        }
        elseif (session('payment_type') == 'seller_package_payment') {
            $amount = round(session('amount'));
            $combined_order_id = rand(10000,99999);
            $billname = 'Seller Package Payment';
            $first_name = $user->name;
            $phone = $user->phone;
            $email = $user->email;
            $success_url=url('/mercadopago/payment/done');
            $fail_url=url('/mercadopago/payment/cancel');
        }
      
        return view('frontend.payment.mercadopago',compact('combined_order_id','billname','phone','amount','first_name','email','success_url','fail_url'));
    }

    public function paymentstatus()
    {
        $response= request()->status;
        if($response == 'approved')
        {
            return ( new PaymentController )->payment_success(null);
        }
        else
        {
            return ( new PaymentController )->payment_failed();
        }
    }

    public function callback()
    {
        return ( new PaymentController )->payment_failed();
    }

}

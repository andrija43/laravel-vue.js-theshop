<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CombinedOrder;
use App\Models\BusinessSetting;
use App\Models\User;
use App\Models\CustomerPackage;
use App\Models\SellerPackage;
use App\Http\Controllers\CustomerPackageController;
use App\Http\Controllers\SellerPackageController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\CheckoutController;
use Session;
use Redirect;
use Illuminate\Support\Facades\Auth;

class IyzicoPaymentController extends Controller
{
    public function index()
    {
        $options = new \Iyzipay\Options();
        $options->setApiKey(env('IYZICO_API_KEY'));
        $options->setSecretKey(env('IYZICO_SECRET_KEY'));

        if (get_setting('iyzico_sandbox') == 1) {
            $options->setBaseUrl("https://sandbox-api.iyzipay.com");
        } else {
            $options->setBaseUrl("https://api.iyzipay.com");
        }      

        if (Session::has('payment_type')) {
            $iyzicoRequest = new \Iyzipay\Request\CreatePayWithIyzicoInitializeRequest();
            $iyzicoRequest->setLocale(\Iyzipay\Model\Locale::TR);
            $iyzicoRequest->setConversationId('123456789');

            $buyer = new \Iyzipay\Model\Buyer();
            $buyer->setId("BY789");
            $buyer->setName("John");
            $buyer->setSurname("Doe");
            $buyer->setEmail(Auth::user()->email);
            $buyer->setIdentityNumber("74300864791");
            $buyer->setRegistrationAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
            $buyer->setCity("Istanbul");
            $buyer->setCountry("Turkey");
            $iyzicoRequest->setBuyer($buyer);

            $shippingAddress = new \Iyzipay\Model\Address();
            $shippingAddress->setContactName("Jane Doe");
            $shippingAddress->setCity("Istanbul");
            $shippingAddress->setCountry("Turkey");
            $shippingAddress->setAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
            $iyzicoRequest->setShippingAddress($shippingAddress);

            $billingAddress = new \Iyzipay\Model\Address();
            $billingAddress->setContactName("Jane Doe");
            $billingAddress->setCity("Istanbul");
            $billingAddress->setCountry("Turkey");
            $billingAddress->setAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
            $iyzicoRequest->setBillingAddress($billingAddress);

            if (Session::get('payment_type') == 'cart_payment') {
                $order = CombinedOrder::where('code', session('order_code'))->first();
                $amount = round($order->grand_total);

                $iyzicoRequest->setPrice($amount);
                $iyzicoRequest->setPaidPrice($amount);
                $iyzicoRequest->setCurrency(env('IYZICO_CURRENCY_CODE', 'TRY'));
                $iyzicoRequest->setBasketId(rand(000000, 999999));
                $iyzicoRequest->setPaymentGroup(\Iyzipay\Model\PaymentGroup::SUBSCRIPTION);
                $iyzicoRequest->setCallbackUrl(route('iyzico.callback', [
                    'payment_type' => Session::get('payment_type'),
                    'amount' => 0,
                    'payment_method' => 0,
                    'combined_order_id' => session('order_code'),
                    'customer_package_id' => 0,
                    'seller_package_id' => 0
                ]));

                $basketItems = array();
                $firstBasketItem = new \Iyzipay\Model\BasketItem();
                $firstBasketItem->setId(rand(1000, 9999));
                $firstBasketItem->setName("Cart Payment");
                $firstBasketItem->setCategory1("Accessories");
                $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::VIRTUAL);
                $firstBasketItem->setPrice($amount);
                $basketItems[0] = $firstBasketItem;

                $iyzicoRequest->setBasketItems($basketItems);
            }

            if (Session::get('payment_type') == 'wallet_payment') {
                $amount = round(session('amount'));
                $iyzicoRequest->setPrice($amount);
                $iyzicoRequest->setPaidPrice($amount);
                $iyzicoRequest->setCurrency(env('IYZICO_CURRENCY_CODE', 'TRY'));
                $iyzicoRequest->setBasketId(rand(000000, 999999));
                $iyzicoRequest->setPaymentGroup(\Iyzipay\Model\PaymentGroup::SUBSCRIPTION);
                $iyzicoRequest->setCallbackUrl(route('iyzico.callback', [
                    'payment_type' => Session::get('payment_type'),
                    'amount' => $amount,
                    'payment_method' => Session::get('payment_method'),
                    'combined_order_id' => 0,
                    'customer_package_id' => 0,
                    'seller_package_id' => 0
                ]));

                $basketItems = array();
                $firstBasketItem = new \Iyzipay\Model\BasketItem();
                $firstBasketItem->setId(rand(1000, 9999));
                $firstBasketItem->setName("Wallet Payment");
                $firstBasketItem->setCategory1("Wallet");
                $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::VIRTUAL);
                $firstBasketItem->setPrice($amount);
                $basketItems[0] = $firstBasketItem;

                $iyzicoRequest->setBasketItems($basketItems);
            }

            if (Session::get('payment_type') == 'seller_package_payment') {
                $amount = round(session('amount'));
                $seller_package = SellerPackage::findOrFail(Session::get('payment_data')['seller_package_id']);

                $iyzicoRequest->setPrice($amount);
                $iyzicoRequest->setPaidPrice($amount);
                $iyzicoRequest->setCurrency(env('IYZICO_CURRENCY_CODE', 'TRY'));
                $iyzicoRequest->setBasketId(rand(000000, 999999));
                $iyzicoRequest->setPaymentGroup(\Iyzipay\Model\PaymentGroup::SUBSCRIPTION);
                $iyzicoRequest->setCallbackUrl(route('iyzico.callback', [
                    'payment_type' => Session::get('payment_type'),
                    'amount' => 0,
                    'payment_method' => Session::get('payment_method'),
                    'combined_order_id' => 0,
                    'customer_package_id' => 0,
                    'seller_package_id' => Session::get('seller_package_id')
                ]));

                $basketItems = array();
                $firstBasketItem = new \Iyzipay\Model\BasketItem();
                $firstBasketItem->setId(rand(1000, 9999));
                $firstBasketItem->setName("Package Payment");
                $firstBasketItem->setCategory1("Package");
                $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::VIRTUAL);
                $firstBasketItem->setPrice($amount);
                $basketItems[0] = $firstBasketItem;

                $iyzicoRequest->setBasketItems($basketItems);
            }

            # make request
            $payWithIyzicoInitialize = \Iyzipay\Model\PayWithIyzicoInitialize::create($iyzicoRequest, $options);
            // dd($payWithIyzicoInitialize);      
            # print result
            return Redirect::to($payWithIyzicoInitialize->getPayWithIyzicoPageUrl());
        } else {
            return (new PaymentController)->payment_failed();
        }
    }

    public function callback(Request $request, $payment_type, $amount = null, $payment_method = null, $combined_order_id = null, $customer_package_id = null, $seller_package_id = null)
    {
        $options = new \Iyzipay\Options();
        $options->setApiKey(env('IYZICO_API_KEY'));
        $options->setSecretKey(env('IYZICO_SECRET_KEY'));

        if (get_setting('iyzico_sandbox') == 1) {
            $options->setBaseUrl("https://sandbox-api.iyzipay.com");
        } else {
            $options->setBaseUrl("https://api.iyzipay.com");
        }

        $iyzicoRequest = new \Iyzipay\Request\RetrievePayWithIyzicoRequest();
        $iyzicoRequest->setLocale(\Iyzipay\Model\Locale::TR);
        $iyzicoRequest->setConversationId('123456789');
        $iyzicoRequest->setToken($request->token);
        # make request
        $payWithIyzico = \Iyzipay\Model\PayWithIyzico::retrieve($iyzicoRequest, $options);

        if ($payWithIyzico->getStatus() == 'success') {
            $response = $payWithIyzico->getRawResult();
            return ( new PaymentController )->payment_success($response);
        } else {
            return (new PaymentController)->payment_failed();
        }
    }
}

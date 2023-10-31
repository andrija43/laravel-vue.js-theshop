<?php

use App\Http\Controllers\Payment\FlutterwavePaymentController;
use App\Http\Controllers\Payment\PaypalPaymentController;
use App\Http\Controllers\Payment\PaystackPaymentController;
use App\Http\Controllers\Payment\PaytmPaymentController;
use App\Http\Controllers\Payment\SSLCommerzPaymentController;
use App\Http\Controllers\Payment\StripePaymentController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Payment\AuthorizenetPaymentController;
use App\Http\Controllers\Payment\PayfastPaymentController;
use App\Http\Controllers\Payment\RazorpayPaymentController;
use App\Http\Controllers\Payment\MercadopagoPaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/offline', 'HomeController@index')->name('offline');

Route::group(['prefix' => 'payment'], function () {

    Route::any('/{gateway}/pay', [PaymentController::class, 'payment_initialize']);

    // stripe
    Route::any('/stripe/create-session', [StripePaymentController::class, 'create_checkout_session'])->name('stripe.get_token');
    Route::get('/stripe/success', [StripePaymentController::class, 'success'])->name('stripe.success');
    Route::get('/stripe/cancel', [StripePaymentController::class, 'cancel'])->name('stripe.cancel');

    // paypal
    Route::get('/paypal/success', [PaypalPaymentController::class, 'success'])->name('paypal.success');
    Route::get('/paypal/cancel', [PaypalPaymentController::class, 'cancel'])->name('paypal.cancel');

    //sslcommerz
    Route::any('/sslcommerz/success', [SSLCommerzPaymentController::class, 'success'])->name('sslcommerz.success');
    Route::any('/sslcommerz/fail', [SSLCommerzPaymentController::class, 'fail'])->name('sslcommerz.fail');
    Route::any('/sslcommerz/cancel', [SSLCommerzPaymentController::class, 'cancel'])->name('sslcommerz.cancel');

    //paystack
    Route::any('/paystack/callback', [PaystackPaymentController::class, 'return'])->name('paystack.return');
    Route::any('/paystack/new-callback', [PaystackPaymentController::class, 'paystackNewCallback']);

    //paytm
    Route::any('/paytm/callback', [PaytmPaymentController::class, 'callback'])->name('paytm.callback');

    //flutterwave
    Route::any('/flutterwave/callback', [FlutterwavePaymentController::class, 'callback'])->name('flutterwave.callback');

    // razorpay
    Route::post('razorpay/payment', [RazorpayPaymentController::class, 'payment'])->name('razorpay.payment');

    //Payfast routes <starts>
    Route::controller(PayfastPaymentController::class)->group(function () {
        Route::any('/payfast/payment/notify', 'payment_notify')->name('payfast.payment.notify');
        Route::any('/payfast/payment/return', 'payment_return')->name('payfast.payment.return');
        Route::any('/payfast/payment/cancel', 'payment_cancel')->name('payfast.payment.cancel');
    });
    //Payfast routes <ends>

    //Mercadopago <starts>
    Route::controller(MercadopagoPaymentController::class)->group(function () {
        Route::any('/mercadopago/payment/done', 'paymentstatus')->name('mercadopago.done');
        Route::any('/mercadopago/payment/cancel', 'callback')->name('mercadopago.cancel');
    });
    //Mercadopago <ends>

    //Iyzico
    Route::any('/iyzico/payment/callback/{payment_type}/{amount?}/{payment_method?}/{combined_order_id?}/{customer_package_id?}/{seller_package_id?}', [IyzicoController::class, 'callback'])->name('iyzico.callback');
});

Route::any('/social-login/redirect/{provider}', [LoginController::class, 'redirectToProvider'])->name('social.login');
Route::get('/social-login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('social.callback');


Route::get('/product/{slug}', [HomeController::class, 'index'])->name('product');
Route::get('/category/{slug}', [HomeController::class, 'index'])->name('products.category');

Route::get('/blog-details/{slug}', [HomeController::class, 'index'])->name('blog.details');



//Address
Route::resource('addresses', AddressController::class);
Route::controller(AddressController::class)->group(function () {
    Route::post('/get-states', 'getStates')->name('get-state');
    Route::post('/get-cities', 'getCities')->name('get-city');
    Route::post('/addresses/update/{id}', 'update')->name('addresses.update');
    Route::get('/addresses/destroy/{id}', 'destroy')->name('addresses.destroy');
    Route::get('/addresses/set_default/{id}', 'set_default')->name('addresses.set_default');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('{slug}', [HomeController::class, 'index'])->where('slug', '.*');

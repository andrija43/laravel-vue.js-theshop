<?php

// use App\Http\Controllers\CustomerPackageController;
use App\Http\Controllers\WalletController;
// use App\Http\Controllers\CustomerPackagePaymentController;
use App\Http\Controllers\ManualPaymentMethodController;
// use App\Http\Controllers\SellerPackageController;
use App\Http\Controllers\SellerPackagePaymentController;

/*
|--------------------------------------------------------------------------
| Offline Payment Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
if(get_setting('offline_payment') == 1){
    //Admin
    Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
        Route::resource('manual_payment_methods', ManualPaymentMethodController::class);
        Route::get('/manual_payment_methods/destroy/{id}', [ManualPaymentMethodController::class, 'destroy'])->name('manual_payment_methods.destroy');
        Route::get('/offline-wallet-recharge-requests', [WalletController::class, 'offline_recharge_request'])->name('offline_wallet_recharge_request.index');
        Route::get('/offline-wallet-recharge/approved/{id}', [WalletController::class, 'updateApproved'])->name('offline_recharge_request.approved');

        // Seller Package purchase request
        Route::get('/offline-seller-package-payment-requests', [SellerPackagePaymentController::class, 'offline_payment_request'])->name('offline_seller_package_payment_request.index');
        Route::get('/offline-seller-package-payment/approved/{id}', [SellerPackagePaymentController::class, 'offline_payment_approval'])->name('offline_seller_package_payment.approved');
    }); 
}
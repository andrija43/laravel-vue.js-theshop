<?php

/*
|--------------------------------------------------------------------------
| Affiliate Routes
|--------------------------------------------------------------------------
|
| Here is where you can register affiliate routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Addons\Affiliate\Http\Controllers\Admin\AffiliateController;

//Admin
Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
	
	Route::controller(AffiliateController::class)->group(function () {

		Route::get('/affiliate/registration-form', 'affiliate_registration_form')->name('affiliate.registration_form');
		Route::post('/affiliate/update-registration-form', 'update_affiliate_registration_form')->name('affiliate.update_registration_form');

		Route::get('/affiliate/configs', 'affiliate_configs')->name('affiliate.configs');
		Route::post('/affiliate/configs', 'affiliate_config_store')->name('affiliate.config_store');

		Route::get('/affiliate/users', 'affiliate_users')->name('affiliate.users');
		Route::get('/affiliate/verification/{id}', 'show_affiliate_verification_info')->name('affiliate_users.show_verification_info');

		Route::get('/affiliate/approve/{id}/{status}', 'affiliate_user_approval')->name('affiliate_user.approval');
		Route::post('/affiliate/approved', 'updateApproved')->name('affiliate_user.approved');

		Route::get('/refferal/users', 'refferal_users')->name('refferal.users');

		Route::post('/affiliate/payment_modal', 'payment_modal')->name('affiliate_user.payment_modal');
        Route::post('/affiliate/pay/store', 'payment_store')->name('affiliate_user.payment_store');
		Route::get('/affiliate/payments/show/{id}', 'payment_history')->name('affiliate_user.payment_history');

        Route::get('/affiliate/withdraw_requests', 'affiliate_withdraw_requests')->name('affiliate.withdraw_requests');
        Route::post('/affiliate/affiliate_withdraw_modal', 'affiliate_withdraw_modal')->name('affiliate_withdraw_modal');
        Route::post('/affiliate/withdraw_request/payment_store', 'withdraw_request_payment_store')->name('withdraw_request.payment_store');
		Route::get('/affiliate/withdraw_request/reject/{id}', 'reject_withdraw_request')->name('affiliate.withdraw_request.reject');
		
		Route::get('/affiliate/logs', 'affiliate_logs')->name('affiliate.logs');
	});
});


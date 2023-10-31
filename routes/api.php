<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AffiliateController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\ClubPointController;
use App\Http\Controllers\Api\ConversationController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\FollowController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\PasswordResetController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RefundRequestController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\Api\SubscribeController;
use App\Http\Controllers\Api\TranslationController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WalletController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Payment\PaymentController;

Route::group(['prefix' => 'v1', 'as' => 'api.'], function () {

    Route::group(['prefix' => 'payment', 'middleware' => 'auth:api'], function () {
        Route::any('/{gateway}/pay', [PaymentController::class, 'payment_initialize']);
    });

    Route::group(['prefix' => 'auth'], function () {
        // banned user
        Route::group(['middleware' => 'unbanned'], function () {
            Route::post('login', [AuthController::class, 'login']);
            Route::post('signup', [AuthController::class, 'signup']);
            Route::post('verify', [AuthController::class, 'verify']);
            Route::post('resend-code', [AuthController::class, 'resend_code']);

            Route::post('password/create', [PasswordResetController::class, 'create']);
            Route::post('password/reset', [PasswordResetController::class, 'reset']);
        });
        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('logout', [AuthController::class, 'logout']);
            Route::get('user', [AuthController::class, 'user']);
        });
    });
    Route::post('temp-id-cart', [AuthController::class, 'tempIdCart']);
    Route::post('temp-id-cart-update', [AuthController::class, 'tempIdCartUpdate']);


    Route::get('locale/{language_code}', [TranslationController::class, 'index']);
    Route::get('setting/home/{section}', [SettingController::class, 'home_setting']);
    Route::get('setting/footer', [SettingController::class, 'footer_setting']);
    Route::get('setting/header', [SettingController::class, 'header_setting']);
    Route::post('subscribe', [SubscribeController::class, 'subscribe']);

    Route::get('all-categories', [CategoryController::class, 'index']);
    Route::get('categories/first-level', [CategoryController::class, 'first_level_categories']);
    Route::get('all-brands', [BrandController::class, 'index']);
    Route::get('all-offers', [OfferController::class, 'index']);
    Route::get('offer/{slug}', [OfferController::class, 'show']);
    Route::get('page/{slug}', [PageController::class, 'show']);

    // Blogs
    Route::get('all-blog-categories', [BlogController::class, 'indexCategory']);
    Route::get('all-blogs/search', [BlogController::class, 'index']);
    Route::get('blog/details/{blog_slug}', [BlogController::class, 'show']);

    Route::group(['prefix' => 'product'], function () {
        Route::get('/details/{product_slug}', [ProductController::class, 'show']);
        Route::post('get-by-ids', [ProductController::class, 'get_by_ids']);
        Route::get('search', [ProductController::class, 'search']);
        Route::get('related/{product_id}', [ProductController::class, 'related']);
        Route::get('bought-together/{product_id}', [ProductController::class, 'bought_together']);
        Route::get('random/{limit}/{product_id?}', [ProductController::class, 'random_products']);
        Route::get('latest/{limit}', [ProductController::class, 'latest_products']);
        Route::get('reviews/{product_id}', [ReviewController::class, 'index']);
    });
    Route::post('compared-list', [ProductController::class, 'productComparedList']);
    Route::get('search.ajax/{keyword}', [ProductController::class, 'ajax_search']);

    Route::get('all-countries', [AddressController::class, 'get_all_countries']);
    Route::get('states/{country_id}', [AddressController::class, 'get_states_by_country_id']);
    Route::get('cities/{state_id}', [AddressController::class, 'get_cities_by_state_id']);

    Route::post('carts', [CartController::class, 'index']);
    Route::post('carts/add', [CartController::class, 'add']);
    Route::post('carts/change-quantity', [CartController::class, 'changeQuantity']);
    Route::post('carts/destroy', [CartController::class, 'destroy']);

    Route::group(['middleware' => ['auth:api', 'unbanned']], function () {

        Route::group(['prefix' => 'checkout'], function () {
            Route::get('get-shipping-cost/{address_id}', [OrderController::class, 'get_shipping_cost']);
            Route::post('order/store', [OrderController::class, 'store']);
            Route::post('coupon/apply', [CouponController::class, 'apply']);
        });

        Route::group(['prefix' => 'user'], function () {

            Route::get('dashboard', [UserController::class, 'dashboard']);

            Route::get('chats', [ChatController::class, 'index']);
            Route::post('chats/send', [ChatController::class, 'send']);
            Route::get('chats/new-messages', [ChatController::class, 'new_messages']);

            Route::get('info', [UserController::class, 'info']);
            Route::post('info/update', [UserController::class, 'updateInfo']);

            Route::get('coupons', [CouponController::class, 'index']);

            Route::get('orders', [OrderController::class, 'index']);
            Route::get('orders/downloads', [OrderController::class, 'productDownloads']);
            Route::get('orders/product/download/{id}', [OrderController::class, 'download']);
            Route::get('order/{order_code}', [OrderController::class, 'show']);
            Route::get('order/cancel/{order_id}', [OrderController::class, 'cancel']);
            Route::get('order/invoice-download/{order_code}', [OrderController::class, 'invoice_download']);

            Route::get('review/check/{product_id}', [ReviewController::class, 'check_review_status']);
            Route::post('review/submit', [ReviewController::class, 'submit_review']);

            Route::apiResource('wishlists', WishlistController::class)->except(['update', 'show']);
            Route::apiResource('follow', FollowController::class)->except(['update', 'show']);

            Route::get('addresses', [AddressController::class, 'addresses']);
            Route::post('address/create', [AddressController::class, 'createShippingAddress']);
            Route::post('address/update', [AddressController::class, 'updateShippingAddress']);
            Route::get('address/delete/{id}', [AddressController::class, 'deleteShippingAddress']);
            Route::get('address/default-shipping/{id}', [AddressController::class, 'defaultShippingAddress']);
            Route::get('address/default-billing/{id}', [AddressController::class, 'defaultBillingAddress']);

            # conversation
            Route::get('querries', [ConversationController::class, 'index']);
            Route::post('new-query', [ConversationController::class, 'store']);
            Route::get('querries/{id}', [ConversationController::class, 'show']);
            Route::post('new-message-query', [ConversationController::class, 'storeMessage']);

            # wallet
            Route::post('wallet/recharge', [WalletController::class, 'recharge']);
            Route::get('wallet/history', [WalletController::class, 'walletRechargeHistory']);

            # club points
            Route::get('earning/history', [ClubPointController::class, 'earningRechargeHistory']);
            Route::post('convert-point-into-wallet', [ClubPointController::class, 'convert_point_into_wallet']);

            // Refund Addon
            Route::get('refund-requests', [RefundRequestController::class, 'index']);
            Route::get('refund-request/create/{order_id}', [RefundRequestController::class, 'create']);
            Route::post('refund-request/store', [RefundRequestController::class, 'store']);

            // affiliate
            Route::controller(AffiliateController::class)->group( function () {
                Route::post('affiliate/withdraw-request', 'withdraw_request_store');
                Route::get('affiliate/withdraw-request',  'withdraw_request_list');
                Route::get('affiliate/payment-history',  'payment_history');
                Route::get('affiliate/earning-history',  'earning_history');
                Route::post('affiliate/payment-settings',  'payment_settings');
                Route::get('affiliate/balance',  'affiliate_balance');
                Route::get('affiliate/referral-code',  'referral_code');
                Route::get('affiliate/stats',  'affiliate_stats');
                Route::get('affiliate/user-check',  'affiliate_user_check');
                Route::post('affiliate/store',  'store');
            });
        });
    });


    //for shops
    Route::post('shop/register', [ShopController::class, 'shop_register']);
    Route::get('all-shops', [ShopController::class, 'index']);
    Route::get('shop/{slug}', [ShopController::class, 'show']);
    Route::get('shop/{slug}/home', [ShopController::class, 'shop_home']);
    Route::get('shop/{slug}/coupons', [ShopController::class, 'shop_coupons']);
    Route::get('shop/{slug}/products', [ShopController::class, 'shop_products']);
    // affiliate
    // Route::post('affiliate/store', [AffiliateController::class, 'store']);
    Route::post('affiliate/registration-refferal-code', [AffiliateController::class, 'registration_refferal_code']);
    Route::post('product-refferal-code', [AffiliateController::class, 'product_refferal_code']);
});

Route::fallback(function () {
    return response()->json([
        'data' => [],
        'success' => false,
        'status' => 404,
        'message' => 'Invalid Route'
    ]);
});

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Affiliate\AffiliateStatResource;
use App\Http\Resources\Affiliate\EarningHistoryResource;
use App\Http\Resources\Affiliate\PaymentHistoryResource;
use App\Http\Resources\Affiliate\WithDrawRequestResource;
use App\Http\Services\AffiliateService;
use App\Http\Services\SmsServices;
use App\Models\AffiliateConfig;
use App\Models\AffiliateLog;
use App\Models\AffiliateOption;
use App\Models\AffiliatePayment;
use App\Models\AffiliateStats;
use App\Models\AffiliateUser;
use App\Models\AffiliateWithdrawRequest;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AffiliateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->check()) {
            dd('auth');
            if (User::where('email', $request->email)->first() != null) {
                return response()->json([
                    'success' => false,
                    'verified' => false,
                    'message' => translate('Email already exists!')
                ], 200);
            }
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'verification_code' => rand(100000, 999999)
            ]);
            $user->save();
            if ($request->has('temp_user_id') && $request->temp_user_id != null) {
                Cart::where('temp_user_id', $request->temp_user_id)->update(
                    [
                        'user_id' => $user->id,
                        'temp_user_id' => null
                    ]
                );
            }

            if (get_setting('customer_otp_with') != 'disabled') {
                if (get_setting('customer_login_with') == 'email' || (get_setting('customer_login_with') == 'email_phone' && get_setting('customer_otp_with') == 'email')) {
                    $user->notify(new EmailVerificationNotification());
                    // return response()->json([
                    //     'success' => true,
                    //     'verified' => false,
                    //     'message' => translate('A verification code has been sent to your email.')
                    // ], 200);
                } else {
                    (new SmsServices)->phoneVerificationSms($user->phone, $user->verification_code);
                    // return response()->json([
                    //     'success' => true,
                    //     'verified' => false,
                    //     'message' => translate('A verification code has been sent to your phone.')
                    // ], 200);
                }
            }

            auth()->login($user, false);

            if (get_setting('email_verification') != 1) {
                $user->email_verified_at = date('Y-m-d H:m:s');
                $user->save();
            } else {
                event(new Registered($user));
            }
        }
        $affiliate_user = auth()->user()->affiliate_user;

        if ($affiliate_user == null) {
            $affiliate_user = new AffiliateUser();
            $affiliate_user->user_id = auth()->user()->id;
        }

        $data = array();
        $i = 0;
        // if (json_decode(AffiliateConfig::where('type', 'verification_form')->first() != null)) {
        //     foreach (json_decode(AffiliateConfig::where('type', 'verification_form')->first()->value) as $key => $element) {
        //         $item = array();
        //         if ($element->type == 'text') {
        //             $item['type'] = 'text';
        //             $item['label'] = $element->label;
        //             $item['value'] = $request['element_' . $i];
        //         } elseif ($element->type == 'select' || $element->type == 'radio') {
        //             $item['type'] = 'select';
        //             $item['label'] = $element->label;
        //             $item['value'] = $request['element_' . $i];
        //         } elseif ($element->type == 'multi_select') {
        //             $item['type'] = 'multi_select';
        //             $item['label'] = $element->label;
        //             $item['value'] = json_encode($request['element_' . $i]);
        //         } elseif ($element->type == 'file') {
        //             $item['type'] = 'file';
        //             $item['label'] = $element->label;
        //             $item['value'] = $request['element_' . $i]->store('uploads/affiliate_verification_form');
        //         }
        //         array_push($data, $item);
        //         $i++;
        //     }
        // }
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['description'] = $request->description;
        $affiliate_user->informations = json_encode($data);

        if ($affiliate_user->save()) {
            return response()->json([
                'success' => true,
                'message' => translate('Your verification request has been submitted successfully!'),
                'data' => null
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => translate('Sorry! Something went wrong.'),
            'data' => null
        ], 200);
    }

    /**
     *  check the registration refferal code and update affiliate stats
     * user_referral_code
     */
    public function registration_refferal_code(Request $request)
    {
        if ($request->has('referralCode')) {
            try {
                $affiliate_validation_time = AffiliateConfig::where('type', 'validation_time')->first();
                $cookie_minute = 30 * 24;
                if ($affiliate_validation_time) {
                    $cookie_minute = $affiliate_validation_time->value * 60;
                }
                $referred_by_user = User::where('referral_code', $request->referralCode)->first();
                $affiliateService = new AffiliateService;
                $affiliateService->processAffiliateStats($referred_by_user->id, 1, 0, 0, 0);
                return response('Cookie has been set')
                ->withCookie(cookie('referral_code', $request->referralCode, $cookie_minute));
            } catch (\Exception $e) {
            }
        }
    }
    /**
     * check the product refferal code and update affiliate stats
     * product_refferal_code
     */
    public function product_refferal_code(Request $request)
    {
        if ($request->has('product_referral_code') && $request->slug) {
            try {
                $product = Product::where('slug', $request->slug)->first();
                $affiliate_validation_time = AffiliateConfig::where('type', 'validation_time')->first();
                $cookie_minute = 30 * 24;
                if ($affiliate_validation_time) {
                    $cookie_minute = $affiliate_validation_time->value * 60;
                }
                $referred_by_user = User::where('referral_code', $request->product_referral_code)->first();
                $affiliateService = new AffiliateService;
                $affiliateService->processAffiliateStats($referred_by_user->id, 1, 0, 0, 0);
                return response('Cookie has been set')
                ->withCookie(cookie('product_referral_code', $request->product_referral_code, $cookie_minute))
                ->withCookie(cookie('referred_product_id', $product->id, $cookie_minute));
            } catch (\Exception $e) {
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function affiliate_balance()
    {
        return response()->json([
            'affiliate_balance' => single_price(auth()->user()->affiliate_user->balance),
            'status' => 200,
        ]);
    }
    public function referral_code()
    {
        return response()->json([
            'referral_code' =>  "http://" . $_SERVER['HTTP_HOST'] . '/user/registration?referral_code=' . auth()->user()->referral_code,
            'status' => 200,
        ]);
    }
    public function withdraw_request_store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|min:1',
        ]);

        $withdrawRequest = AffiliateWithdrawRequest::create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'status' => 0
        ]);

        return response()->json([
            'result' => true,
            'data' => $request->amount,
            'message' => 'Request submitted successfully! Please wait for approval'
        ]);
    }

    public function withdraw_request_list()
    {
        $withdrawRequest = AffiliateWithdrawRequest::where('user_id', auth()->id())->latest()->paginate(5);
        return WithDrawRequestResource::collection($withdrawRequest);
    }
    public function payment_history()
    {
        $paymentHistory = AffiliatePayment::where('affiliate_user_id', auth()->id())->latest()->paginate(5);
        return PaymentHistoryResource::collection($paymentHistory);
    }
    public function earning_history()
    {
        $earningHistory = AffiliateLog::where('referred_by_user_id', auth()->id())->latest()->paginate(5);
        return EarningHistoryResource::collection($earningHistory);
    }
    public function affiliate_stats()
    {
        $stats = AffiliateStats::selectRaw('sum(no_of_click) as click, sum(no_of_order_item) as item, sum(no_of_delivered) as delivered , sum(no_of_cancel) as cancel ')->where('affiliate_user_id', auth()->id())->first();
        return new AffiliateStatResource($stats);
    }
    public function payment_settings(Request $request)
    {
        $affiliate_user = auth()->user()->affiliate_user;
        $affiliate_user->paypal_email = $request->paypalEmail;
        $affiliate_user->bank_information = $request->bankInformations;
        $affiliate_user->save();
        return response()->json([
            'message' => 'Affiliate payment settings has been updated successfully',
            'status' => 200,
        ]);
    }
    public function affiliate_user_check(){
        $user = auth()->user();
        $affiliated_user =   $user->affiliate_user ? ($user->affiliate_user->status == 1? true : false) : false ;
        $user_referral_code =   $user->referral_code;
        $affiliate_option = ((get_setting('affiliate_system') == 1) && (AffiliateOption::where('type', 'product_sharing')->first()->status || AffiliateOption::where('type', 'category_wise_affiliate')->first()->status)) ? true : false;
        return response()->json([
            'affiliated_user'=> $affiliated_user,
            'user_referral_code'=> $user_referral_code,
            'affiliate_option'=> $affiliate_option,
            'status' => 200,
        ]);
    }
}

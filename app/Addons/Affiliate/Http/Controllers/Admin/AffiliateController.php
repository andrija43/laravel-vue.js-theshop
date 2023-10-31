<?php

namespace App\Addons\Affiliate\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AffiliateLog;
use App\Models\AffiliateOption;
use App\Models\AffiliatePayment;
use App\Models\AffiliateUser;
use App\Models\AffiliateWithdrawRequest;
use App\Models\Category;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AffiliateController extends Controller
{
    public function __construct()
    {
        //    
    }

    public function affiliate_registration_form()
    {
        return view('addon:affiliate::admin.affiliate_registration_form');
    }

    public function update_affiliate_registration_form(Request $request)
    {
        $form = array();
        $select_types = ['select', 'multi_select', 'radio'];
        $j = 0;
        for ($i = 0; $i < count($request->type); $i++) {
            $item['type'] = $request->type[$i];
            $item['label'] = $request->label[$i];
            if (in_array($request->type[$i], $select_types)) {
                $item['options'] = json_encode($request['options_' . $request->option[$j]]);
                $j++;
            }
            array_push($form, $item);
        }
        $affiliate_config = Setting::where('type', 'verification_form')->first();
        $affiliate_config->value = json_encode($form);
        $affiliate_config->save();

        cache_clear();

        flash("Verification form updated successfully")->success();
        return back();
    }


    public function affiliate_configs()
    {
        return view('addon:affiliate::admin.affiliate_configs');
    }

    // Affiliate Configuration Store
    public function affiliate_config_store(Request $request)
    {
        // dd($request->all());
        $affiliate_option = AffiliateOption::where('type', $request->type)->first();
        $affiliate_option->type = $request->type;

        $commision_details = array();
        if ($request->type == 'user_registration_first_purchase') {
            $affiliate_option->percentage = $request->percentage;
        } elseif ($request->type == 'product_sharing') {
            $commision_details['commission'] = $request->amount;
            $commision_details['commission_type'] = $request->amount_type;
        } elseif ($request->type == 'category_wise_affiliate') {
            foreach (Category::all() as $category) {
                $data['category_id'] = $request['categories_id_' . $category->id];
                $data['commission'] = $request['commison_amounts_' . $category->id];
                $data['commission_type'] = $request['commison_types_' . $category->id];
                array_push($commision_details, $data);
            }
        }
        $affiliate_option->details = json_encode($commision_details);


        if ($request->has('status')) {
            $affiliate_option->status = 1;
            if ($request->type == 'product_sharing') {
                $affiliate_option_status_update = AffiliateOption::where('type', 'category_wise_affiliate')->first();
                $affiliate_option_status_update->status = 0;
                $affiliate_option_status_update->save();
            }
            if ($request->type == 'category_wise_affiliate') {
                $affiliate_option_status_update = AffiliateOption::where('type', 'product_sharing')->first();
                $affiliate_option_status_update->status = 0;
                $affiliate_option_status_update->save();
            }
        } else {
            $affiliate_option->status = 0;
        }
        $affiliate_option->save();

        flash("This has been updated successfully")->success();
        return back();
    }

    public function affiliate_users()
    {
        $affiliate_users = AffiliateUser::paginate(12);
        return view('addon:affiliate::admin.affiliate_users', compact('affiliate_users'));
    }

    public function show_affiliate_verification_info($id)
    {
        $affiliate_user = AffiliateUser::findOrFail($id);
        return view('addon:affiliate::admin.show_verification_info', compact('affiliate_user'));
    }

    public function affiliate_user_approval($id, $status)
    {
        $affiliate_user = AffiliateUser::findOrFail($id);
        $affiliate_user->status = $status == 1 ? 1 : 0;
        $msg = $status == 1 ? 'Affiliate user has been approved successfully' : 'Affiliate user request has been rejected successfully';
        $referral_code = substr($affiliate_user->id . Str::random(), 0, 10);
        User::find($affiliate_user->user_id)->update(['referral_code' => $referral_code]);
        if ($affiliate_user->save()) {
            flash(translate($msg))->success();
            return redirect()->route('affiliate.users');
        }
        flash(translate('Something went wrong'))->error();
        return back();
    }

    public function updateApproved(Request $request)
    {
        $affiliate_user = AffiliateUser::findOrFail($request->id);
        $affiliate_user->status = $request->status;
        $referral_code = substr($affiliate_user->id . Str::random(), 0, 10);
        User::find($affiliate_user->user_id)->update(['referral_code' => $referral_code]);
        if ($affiliate_user->save()) {
            return 1;
        }
        return 0;
    }

    // Affiliate User paymant Modal show
    public function payment_modal(Request $request)
    {
        $affiliate_user = AffiliateUser::findOrFail($request->id);
        return view('addon:affiliate::admin.affiliate_payment_modal', compact('affiliate_user'));
    }

    // Pay to the Affiliate user
    public function payment_store(Request $request)
    {
        $affiliate_payment = new AffiliatePayment;
        $affiliate_payment->affiliate_user_id = $request->affiliate_user_id;
        $affiliate_payment->amount = $request->amount;
        $affiliate_payment->payment_method = $request->payment_method;
        $affiliate_payment->save();

        $affiliate_user = AffiliateUser::findOrFail($request->affiliate_user_id);
        $affiliate_user->balance -= $request->amount;
        $affiliate_user->save();

        flash(translate('Payment completed'))->success();
        return back();
    }

    // Affiliate Payment History
    public function payment_history($id)
    {
        $affiliate_user = AffiliateUser::findOrFail(decrypt($id));
        $affiliate_payments = $affiliate_user->affiliate_payments();
        return view('addon:affiliate::admin.affiliate_payment_history', compact('affiliate_payments', 'affiliate_user'));
    }

    // Referral Users
    public function refferal_users()
    {
        $refferal_users = User::where('referred_by', '!=', null)->paginate(10);
        return view('addon:affiliate::admin.refferal_users', compact('refferal_users'));
    }

    // Withdraw Request
    public function affiliate_withdraw_requests()
    {
        $affiliate_withdraw_requests = AffiliateWithdrawRequest::orderBy('id', 'desc')->paginate(10);
        return view('addon:affiliate::admin.affiliate_withdraw_requests', compact('affiliate_withdraw_requests'));
    }

    public function affiliate_withdraw_modal(Request $request)
    {
        $affiliate_withdraw_request = AffiliateWithdrawRequest::findOrFail($request->id);
        $affiliate_user = AffiliateUser::where('user_id', $affiliate_withdraw_request->user_id)->first();
        return view('addon:affiliate::admin.affiliate_withdraw_modal', compact('affiliate_withdraw_request', 'affiliate_user'));
    }

    public function withdraw_request_payment_store(Request $request)
    {
        $affiliate_payment = new AffiliatePayment;
        $affiliate_payment->affiliate_user_id = $request->affiliate_user_id;
        $affiliate_payment->amount = $request->amount;
        $affiliate_payment->payment_method = $request->payment_method;
        $affiliate_payment->save();

        if ($request->has('affiliate_withdraw_request_id')) {
            $affiliate_withdraw_request = AffiliateWithdrawRequest::findOrFail($request->affiliate_withdraw_request_id);
            $affiliate_withdraw_request->status = 1;
            $affiliate_withdraw_request->save();
        }
        $affiliate_user = AffiliateUser::where('user_id', $request->affiliate_user_id)->first();
        if ($affiliate_user) {
            $affiliate_user->balance -= $request->amount;
            $affiliate_user->save();
        }
        flash(translate('Payment completed'))->success();
        return back();
    }


    // Reject Withdraw Request
    public function reject_withdraw_request($id)
    {
        $affiliate_withdraw_request = AffiliateWithdrawRequest::findOrFail($id);
        $affiliate_withdraw_request->status = 2;
        $affiliate_withdraw_request->save();
        flash(translate('Affiliate withdraw request has been rejected successfully'))->success();
        return redirect()->route('affiliate.withdraw_requests');
    }

    public function affiliate_logs()
    {
        $affiliate_logs = AffiliateLog::latest()->paginate(10);
        return view('addon:affiliate::admin.affiliate_logs', compact('affiliate_logs'));
    }
}

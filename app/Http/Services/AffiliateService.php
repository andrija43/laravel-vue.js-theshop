<?php

namespace App\Http\Services;

use App\Models\AffiliateLog;
use App\Models\AffiliateOption;
use App\Models\AffiliateStats;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class AffiliateService
{
        public function processAffiliateStats($affiliate_user_id, $no_click = 0, $no_item = 0, $no_delivered = 0, $no_cancel = 0)
        {

                $affiliate_stats = AffiliateStats::whereDate('created_at', Carbon::today())
                        ->where("affiliate_user_id", $affiliate_user_id)
                        ->first();
                if (!$affiliate_stats) {
                        $affiliate_stats = new AffiliateStats;
                        $affiliate_stats->no_of_order_item = 0;
                        $affiliate_stats->no_of_delivered = 0;
                        $affiliate_stats->no_of_cancel = 0;
                        $affiliate_stats->no_of_click = 0;
                }
                $affiliate_stats->no_of_order_item += $no_item;
                $affiliate_stats->no_of_delivered += $no_delivered;
                $affiliate_stats->no_of_cancel += $no_cancel;
                $affiliate_stats->no_of_click += $no_click;
                $affiliate_stats->affiliate_user_id = $affiliate_user_id;
                $affiliate_stats->save();
        }


        public function processAffiliatePoints(Order $order)
        {
                if (AffiliateOption::where('type', 'user_registration_first_purchase')->first()->status) {
                        if ($order->user != null && $order->user->orders->count() == 1) {
                                if ($order->user->referred_by != null) {
                                        $user = User::find($order->user->referred_by);
                                        if ($user != null) {
                                                $amount = (AffiliateOption::where('type', 'user_registration_first_purchase')->first()->percentage * $order->grand_total) / 100;
                                                $affiliate_user = $user->affiliate_user;
                                                if ($affiliate_user != null) {
                                                        $affiliate_user->balance += $amount;
                                                        $affiliate_user->save();

                                                        // Affiliate log
                                                        $affiliate_log                      = new AffiliateLog;
                                                        $affiliate_log->user_id             = $order->user_id;
                                                        $affiliate_log->referred_by_user_id    = $order->user->referred_by;
                                                        $affiliate_log->amount              = $amount;
                                                        $affiliate_log->order_id            = $order->id;
                                                        $affiliate_log->affiliate_type      = 'user_registration_first_purchase';
                                                        $affiliate_log->save();
                                                }
                                        }
                                }
                        }
                }
                if (AffiliateOption::where('type', 'product_sharing')->first()->status) {
                        foreach ($order->orderDetails as $key => $orderDetail) {
                                $amount = 0;
                                if ($orderDetail->product_referral_code != null) {
                                        $referred_by_user = User::where('referral_code', $orderDetail->product_referral_code)->first();
                                        if ($referred_by_user != null) {
                                                if (AffiliateOption::where('type', 'product_sharing')->first()->details != null && json_decode(AffiliateOption::where('type', 'product_sharing')->first()->details)->commission_type == 'amount') {
                                                        $amount = json_decode(AffiliateOption::where('type', 'product_sharing')->first()->details)->commission;
                                                } elseif (AffiliateOption::where('type', 'product_sharing')->first()->details != null && json_decode(AffiliateOption::where('type', 'product_sharing')->first()->details)->commission_type == 'percent') {
                                                        $amount = (json_decode(AffiliateOption::where('type', 'product_sharing')->first()->details)->commission * $orderDetail->price) / 100;
                                                }
                                                $affiliate_user = $referred_by_user->affiliate_user;
                                                if ($affiliate_user != null) {
                                                        $affiliate_user->balance += $amount;
                                                        $affiliate_user->save();

                                                        // Affiliate log
                                                        $affiliate_log                      = new AffiliateLog;
                                                        if ($order->user_id != null) {
                                                                $affiliate_log->user_id         = $order->user_id;
                                                        } else {
                                                                $affiliate_log->guest_id        = $order->guest_id;
                                                        }
                                                        $affiliate_log->referred_by_user_id    = $referred_by_user->id;
                                                        $affiliate_log->amount              = $amount;
                                                        $affiliate_log->order_id            = $order->id;
                                                        $affiliate_log->order_detail_id     = $orderDetail->id;
                                                        $affiliate_log->affiliate_type      = 'product_sharing';
                                                        $affiliate_log->save();
                                                }
                                        }
                                }
                        }
                } elseif (AffiliateOption::where('type', 'category_wise_affiliate')->first()->status) {
                        foreach ($order->orderDetails as $key => $orderDetail) {
                                $amount = 0;
                                if ($orderDetail->product_referral_code != null) {
                                        $referred_by_user = User::where('referral_code', $orderDetail->product_referral_code)->first();
                                        if ($referred_by_user != null) {
                                                if (AffiliateOption::where('type', 'category_wise_affiliate')->first()->details != null) {
                                                        foreach (json_decode(AffiliateOption::where('type', 'category_wise_affiliate')->first()->details) as $key => $value) {
                                                                if ((int) $value->category_id == $orderDetail->product->main_category) {
                                                                        if ($value->commission_type == 'amount') {
                                                                                $amount = $value->commission;
                                                                        } else {
                                                                                $amount = ($value->commission * $orderDetail->price) / 100;
                                                                        }
                                                                }
                                                        }
                                                }
                                                $affiliate_user = $referred_by_user->affiliate_user;
                                                if ($affiliate_user != null) {
                                                        $affiliate_user->balance += $amount;
                                                        $affiliate_user->save();

                                                        // Affiliate log
                                                        $affiliate_log                      = new AffiliateLog;
                                                        if ($order->user_id != null) {
                                                                $affiliate_log->user_id         = $order->user_id;
                                                        } else {
                                                                $affiliate_log->guest_id        = $order->guest_id;
                                                        }
                                                        $affiliate_log->referred_by_user_id    = $referred_by_user->id;
                                                        $affiliate_log->amount              = $amount;
                                                        $affiliate_log->order_id            = $order->id;
                                                        $affiliate_log->order_detail_id     = $orderDetail->id;
                                                        $affiliate_log->affiliate_type      = 'category_wise_affiliate';
                                                        $affiliate_log->save();
                                                }
                                        }
                                }
                        }
                }
        }
}

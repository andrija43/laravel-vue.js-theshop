<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;

class WalletController extends Controller
{
    public function offline_recharge_request()
    {
        $wallets = Wallet::where('offline_payment', 1)->paginate(10);
        return view('backend.manual_payment_methods.wallet_request', compact('wallets'));
    }

    public function updateApproved($id)
    {
        $wallet = Wallet::findOrFail($id);
        $wallet->approval = 1;
        $wallet->type = "Added";

        $user = $wallet->user;
        $user->balance = $user->balance + $wallet->amount;
        $user->save();
        if($wallet->save()){
            flash(translate('Offline wallet recharge approved successfully.'))->success();
            return back();
        }
        flash(translate('Something went wrong'))->error();
        return back();
    }
}

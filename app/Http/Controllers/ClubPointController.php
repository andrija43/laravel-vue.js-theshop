<?php
 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\ClubPointDetail;
use App\Models\ClubPoint; 
use App\Models\Product;
use App\Models\Wallet;
use App\Models\Order; 
use Artisan;
use Auth;

class ClubPointController extends Controller
{
    public function configure_index()
    {   
        $products = Product::latest()->paginate(15);
        return view('backend.club_points.config',compact('products'));
    }

    public function index()
    {
        $club_points = ClubPoint::latest()->paginate(15);
        return view('backend.club_points.index', compact('club_points'));
    }

    public function userpoint_index()
    {
        $club_points = ClubPoint::where('user_id', Auth::user()->id)->latest()->paginate(15);
        return view('backend.club_points.frontend.index', compact('club_points'));
    }

    public function set_products_point(Request $request)
    {
        $products = Product::where('lowest_price','>=',$request->min_price)->where('highest_price','<=',$request->max_price)->get();
        foreach ($products as $product) {
            $product->earn_point = $request->point;
            $product->save();
        }
        flash(translate('Point has been inserted successfully for ').count($products).translate(' products'))->success();
        return redirect()->route('club_points.configs');
    }

    public function set_all_products_point(Request $request)
    {
        $products = Product::all();
        foreach ($products as $product) {;
            $product->earn_point = product_base_price($product) * $request->point;
            $product->save();
        }
        flash(translate('Point has been inserted successfully for ').count($products).translate(' products'))->success();
        return redirect()->route('club_points.configs');
    }

    public function set_point_edit($id)
    {
        $product = Product::findOrFail(decrypt($id));
        return view('backend.club_points.product_point_edit', compact('product'));
    }

    public function update_product_point(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->earn_point = $request->point;
        $product->save();
        flash(translate('Point has been updated successfully'))->success();
        return redirect()->route('club_points.configs');
    }

    public function convert_rate_store(Request $request)
    {
        $club_point_convert_rate = Setting::where('type', $request->type)->first();
        if ($club_point_convert_rate != null) {
            $club_point_convert_rate->value = $request->value;
        }
        else {
            $club_point_convert_rate = new Setting;
            $club_point_convert_rate->type = $request->type;
            $club_point_convert_rate->value = $request->value;
        }
        $club_point_convert_rate->save();
        
        Artisan::call('cache:clear');
        
        flash(translate('Point convert rate has been updated successfully'))->success();
        return redirect()->route('club_points.configs');
    }

    public function processClubPoints(Order $order)
    {
        $club_point = new ClubPoint;
        $club_point->user_id = $order->user_id;
        $club_point->points = 0;
        foreach ($order->orderDetails as $key => $orderDetail) {
            $total_pts = ($orderDetail->product->earn_point) * $orderDetail->quantity;
            $club_point->points += $total_pts;
        }
        $club_point->order_id = $order->id;
        $club_point->convert_status = 0;
        $club_point->save();

        foreach ($order->orderDetails as $key => $orderDetail) {
            $club_point_detail = new ClubPointDetail;
            $club_point_detail->club_point_id = $club_point->id;
            $club_point_detail->product_id = $orderDetail->product_id;
            $club_point_detail->point = ($orderDetail->product->earn_point) * $orderDetail->quantity;
            $club_point_detail->save();
        }
    }

    public function club_point_detail($id)
    {
        $club_point_details = ClubPointDetail::where('club_point_id', decrypt($id))->paginate(12);
        return view('backend.club_points.club_point_details', compact('club_point_details'));
    }

    public function convert_point_into_wallet(Request $request)
    {
        $club_point = ClubPoint::findOrFail($request->el);
		if($club_point->convert_status == 0) {
			$wallet = new Wallet;
			$wallet->user_id = Auth::user()->id;
			$wallet->amount = floatval($club_point->points / get_setting('club_point_convert_rate'));
			$wallet->payment_method = 'Club Point Convert';
			$wallet->payment_details = 'Club Point Convert';
			$wallet->save();
			$user = Auth::user();
			$user->balance = $user->balance + floatval($club_point->points / get_setting('club_point_convert_rate'));
			$user->save();
			$club_point->convert_status = 1;
		}
		
        if ($club_point->save()) {
            return 1;
        }
        else {
            return 0;
        }
    }
}

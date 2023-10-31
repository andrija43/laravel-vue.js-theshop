<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Order;
use App\Models\City;
use App\Models\User;
use App\Models\Address;
use App\Models\CombinedOrder;
use App\Models\Country;
use App\Models\OrderUpdate;
use App\Models\ProductCategory;
use App\Models\ProductVariation;
use App\Models\ProductVariationCombination;
use App\Models\Shop;
use App\Models\State;
use App\Utility\CategoryUtility;
use App\Mail\InvoiceEmailManager;
use App\Http\Resources\PosProductCollection;
use DB;
use Str;
use Session;
use Auth;
use Mail;

class PosController extends Controller
{
    public function __construct() {
        // Staff Permission Check
        if(Auth::user() && Auth::user()->user_type != 'seller'){
            $this->middleware(['permission:pos_manager'])->only('index');
        }
        $this->middleware(['permission:pos_configuration'])->only('pos_activation');
    }

    public function index()
    {
        $customers = User::where('user_type', 'customer')->orderBy('created_at', 'desc')->get();
		
        if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff') {
            return view('backend.pos.index', compact('customers'));
        }
        else {
            if (get_setting('pos_activation_for_seller') == 1) {
                return view('backend.pos.frontend.seller.pos.index', compact('customers'));
            }
            else {
                flash(translate('POS is disabled for Sellers!!!'))->error();
                return back();
            }
        }
    }

    public function search(Request $request)
    {
        $products = Product::with('variations')->leftJoin('product_variation_combinations', 'product_variation_combinations.product_id', '=', 'products.id')
                        ->leftJoin('attribute_values','product_variation_combinations.attribute_value_id', '=', 'attribute_values.id')
                        ->select('products.*', 'product_variation_combinations.id as product_variation_combination_id', 'attribute_values.name as attribute_value_name')
                        ->where('products.shop_id', Auth::user()->shop_id)
                        ->where('approved', '1')
                        ->where('approved', 1)
                        ->where('published', '1');
                        
        if($request->category != null){
            $category_id = (int) Str::replace('category-','', $request->category);
            $category_ids = CategoryUtility::children_ids($category_id);
            $category_ids[] = $category_id;

            $product_categories_products = ProductCategory::whereIn('category_id', $category_ids)->pluck('product_id');
            $products->whereIn('products.id', $product_categories_products);
        }

        if($request->brand != null){
            $products = $products->where('products.brand_id', $request->brand);
        }

        if ($request->keyword != null) {
            $products = $products->where('products.name', 'like', '%'.$request->keyword.'%');
        } 

        $stocks = new PosProductCollection($products->paginate(16));
        $stocks->appends(['keyword' =>  $request->keyword,'category' => $request->category, 'brand' => $request->brand]);
        return $stocks;
    }

    public function addToCart(Request $request)
    {
        $data = array();
        if(!is_null($request->product_variation_combination_id)){
            $combination = ProductVariationCombination::find((int)$request->product_variation_combination_id);
            $product_variation = $combination->variation;
            $data['variant'] = $combination->attribute_value->name;
        }else{
            $product_variation = ProductVariation::find((int) $request->variation_id);
            $data['variant'] ='';
        }
        
        $data['variation_id'] = $product_variation->id;
        $data['id'] = $product_variation->product->id;
        $data['quantity'] = $product_variation->product->min_qty;

        $tax = 0;
        $price = $product_variation->price;

        // discount calculation
        $discount_applicable = false;
        if ($product_variation->product->discount_start_date == null) {
            $discount_applicable = true;
        }
        elseif (strtotime(date('d-m-Y H:i:s')) >= $product_variation->product->discount_start_date &&
            strtotime(date('d-m-Y H:i:s')) <= $product_variation->product->discount_end_date) {
            $discount_applicable = true;
        }
        if ($discount_applicable) {
            if($product_variation->product->discount_type == 'percent'){
                $price -= ($price*$product_variation->product->discount)/100;
            }
            elseif($product_variation->product->discount_type == 'amount'){
                $price -= $product_variation->product->discount;
            }
        }

        //tax calculation
        foreach ($product_variation->product->taxes as $product_tax) {
            if($product_tax->tax_type == 'percent'){
                $tax += ($price * $product_tax->tax) / 100;
            }
            elseif($product_tax->tax_type == 'amount'){
                $tax += $product_tax->tax;
            }
        }

        $data['price'] = $price;
        $data['tax'] = $tax;

        if($request->session()->has('pos.cart')){
            $foundInCart = false;
            $cart = collect();

            foreach ($request->session()->get('pos.cart') as $key => $cartItem){
                if($cartItem['id'] ==$product_variation->product->id && $cartItem['variation_id'] == $product_variation->id){
                    $foundInCart = true; 
                    $cartItem['quantity'] += 1; 
                }
                $cart->push($cartItem);
            }

            if (!$foundInCart) {
                $cart->push($data);
            }
            $request->session()->put('pos.cart', $cart);
        }
        else{
            $cart = collect([$data]);
            $request->session()->put('pos.cart', $cart);
        }

        $request->session()->put('pos.cart', $cart);

        return array('success' => 1, 'message' => '', 'view' => view('backend.pos.cart')->render());
    }

    //updated the quantity for a cart item
    public function updateQuantity(Request $request)
    {
        $cart = $request->session()->get('pos.cart', collect([]));
        $cart = $cart->map(function ($object, $key) use ($request) {
            if($key == $request->key){
                $object['quantity'] = $request->quantity;
            }
            return $object;
        });
        $request->session()->put('pos.cart', $cart);

        return array('success' => 1, 'message' => '', 'view' => view('backend.pos.cart')->render());
    }

    //removes from Cart
    public function removeFromCart(Request $request)
    {
        if(Session::has('pos.cart')){
            $cart = Session::get('pos.cart', collect([]));
            $cart->forget($request->key);
            Session::put('pos.cart', $cart);

            $request->session()->put('pos.cart', $cart);
        }

        return view('backend.pos.cart');
    }

    //Shipping Address for admin
    public function getShippingAddress(Request $request){
        $user_id = $request->id;
        if($user_id == ''){
            return view('backend.pos.guest_shipping_address');
        }
        else{
            return view('backend.pos.shipping_address', compact('user_id'));
        }
    }

    //Shipping Address for seller
    public function getShippingAddressForSeller(Request $request){
        $user_id = $request->id;
        if($user_id == ''){
            return view('backend.pos.frontend.seller.pos.guest_shipping_address');
        }
        else{
            return view('backend.pos.frontend.seller.pos.shipping_address', compact('user_id'));
        }
    }

    public function set_shipping_address(Request $request) {
        if ($request->address_id != null) {
            $address = Address::findOrFail($request->address_id);
            $data['name'] = $address->user->name;
            $data['email'] = $address->user->email;
            $data['address'] = $address->address;
            $data['country'] = $address->country;
            $data['state'] = $address->state;
            $data['city'] = $address->city;
            $data['postal_code'] = $address->postal_code;
            $data['phone'] = $address->phone;
        } else {
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['address'] = $request->address;
            $data['country'] = Country::find($request->country_id)->name;
            $data['state'] = State::find($request->state_id)->name;
            $data['city'] = City::find($request->city_id)->name;
            $data['postal_code'] = $request->postal_code;
            $data['phone'] = $request->phone;
        }

        $shipping_info = $data;
        $request->session()->put('pos.shipping_info', $shipping_info);
    }

    //set Discount
    public function setDiscount(Request $request){
        if($request->discount >= 0){
            Session::put('pos.discount', $request->discount);
        }
        return view('backend.pos.cart');
    }

    //set Shipping Cost
    public function setShipping(Request $request){
        if($request->shipping != null){
            Session::put('pos.shipping', $request->shipping);
        }
        return view('backend.pos.cart');
    }

    //order summary
    public function get_order_summary(Request $request){
        return view('backend.pos.order_summary');
    }

    //order place
    public function order_store(Request $request){
        if(Session::get('pos.shipping_info') == null || Session::get('pos.shipping_info')['name'] == null || Session::get('pos.shipping_info')['phone'] == null || Session::get('pos.shipping_info')['address'] == null){
            return array('success' => 0, 'message' => translate("Please Add Shipping Information."));
        }

        if(Session::has('pos.cart') && count(Session::get('pos.cart')) > 0){

            $shipping_info = Session::get('pos.shipping_info');
            $data['name']           = $shipping_info['name'];
            $data['email']          = $shipping_info['email'];
            $data['address']        = $shipping_info['address'];
            $data['country']        = $shipping_info['country'];
            $data['city']           = $shipping_info['city'];
            $data['state']           = $shipping_info['state'];
            $data['postal_code']    = $shipping_info['postal_code'];
            $data['phone']          = $shipping_info['phone'];

            $combined_order = new CombinedOrder;
            
            if ($request->user_id == null) {
                $combined_order->guest_id    = mt_rand(100000, 999999);
            }
            else {
                $combined_order->user_id = $request->user_id;
            }
 
            $combined_order->code = date('Ymd-His') . rand(10, 99);
            $combined_order->shipping_address = json_encode($data);
            $combined_order->billing_address = json_encode($data);
                 
            $grand_total = 0;
            $package_number = 1;

            if($combined_order->save()){
                
                $subtotal = 0;
                $tax = 0;
                $shop_id = Auth::user()->shop_id;
                $order = Order::create([
                    'user_id' => $request->user_id == null ? mt_rand(100000, 999999):  $request->user_id,
                    'shop_id' => $shop_id,
                    'combined_order_id' => $combined_order->id,
                    'code' => $package_number,
                    'shipping_address' => $combined_order->shipping_address,
                    'billing_address' => $combined_order->billing_address,
                    'shipping_cost' => Session::get('pos.shipping', 0), 
                    'grand_total' => 0,
                    'coupon_code' => null,
                    'coupon_discount' => 0,
                    'delivery_type' => 'standard',
                    'payment_type' => $request->payment_type,
                    'payment_status' => $request->payment_type != 'cash_on_delivery' ? 'paid' : 'unpaid',
                ]);

                foreach (Session::get('pos.cart') as $key => $cartItem){
                    $product_variation = ProductVariation::where('id', $cartItem['variation_id'] )->first();

                    $itemUnitPriceWithoutTax = variation_discounted_price($product_variation->product, $product_variation,false);
                    $itemPriceWithoutTax = variation_discounted_price($product_variation->product, $product_variation,false) * $cartItem['quantity'];
                    $itemTax = product_variation_tax($product_variation->product,$product_variation);
                    $totalTax = product_variation_tax($product_variation->product,$product_variation) * $cartItem['quantity'];
                    
                    $subtotal += $itemPriceWithoutTax;
                    $tax += $totalTax;

                    $orderDetail = OrderDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $product_variation->product->id,
                        'product_variation_id' => $product_variation->id,
                        'price' => $itemUnitPriceWithoutTax,
                        'tax' => $itemTax ,
                        'total' => ($itemUnitPriceWithoutTax+$itemTax)*$cartItem['quantity'],
                        'quantity' => $cartItem['quantity'],
                    ]);
    
                    $product_variation->product->update([
                        'num_of_sale' => DB::raw('num_of_sale + ' . $cartItem['quantity'])
                    ]);
    
                    foreach($orderDetail->product->categories as $category){
                        $category->sales_amount += $orderDetail->total;
                        $category->save();
                    }
    
                    $brand = $orderDetail->product->brand;
                    if($brand){
                        $brand->sales_amount += $orderDetail->total;
                        $brand->save();
                    }
                }
                
                $grand_total = $subtotal + $tax + Session::get('pos.shipping', 0);

                if(Session::has('pos.discount')){
                    $grand_total -= Session::get('pos.discount');
                    $order->coupon_discount =Session::get('pos.discount');
                }

                $order->grand_total = $grand_total;
                $combined_order->grand_total = $grand_total;
                $combined_order->save();
                
                $order_price = $order->grand_total - $order->shipping_cost - $order->orderDetails->sum(function ($t) {
                    return $t->tax * $t->quantity;
                });

                $shop_commission = Shop::find($shop_id)->commission;
                $admin_commission = 0.00;
                $seller_earning = $subtotal;
                if($shop_commission > 0){
                    $admin_commission = ($shop_commission * $order_price) / 100;
                    $seller_earning = $subtotal - $admin_commission;
                }

                $order->admin_commission = $admin_commission;
                $order->seller_earning = $seller_earning;
                $order->commission_percentage = $shop_commission;
                $order->save();

                OrderUpdate::create([
                    'order_id' => $order->id,
                    'user_id' => $request->user_id == null ? mt_rand(100000, 999999):  $request->user_id,
                    'note' => 'Order has been placed.',
                ]);
                 
            
                $array['view'] = 'emails.invoice';
                $array['subject'] = 'Your order has been placed - '.$order->code;
                $array['from'] = env('MAIL_USERNAME');
                $array['order'] = $order;

                $admin_products = array();
                $seller_products = array();

                foreach ($order->orderDetails as $key => $orderDetail){
                    if($orderDetail->product->added_by == 'admin'){
                        array_push($admin_products, $orderDetail->product->id);
                    }
                    else{
                        $product_ids = array();
                        if(array_key_exists($orderDetail->product->user_id, $seller_products)){
                            $product_ids = $seller_products[$orderDetail->product->user_id];
                        }
                        array_push($product_ids, $orderDetail->product->id);
                        $seller_products[$orderDetail->product->user_id] = $product_ids;
                    }
                }

                foreach($seller_products as $key => $seller_product){
                    try {
                        Mail::to(User::find($key)->email)->queue(new InvoiceEmailManager($array));
                    } catch (\Exception $e) {

                    }
                }

                //sends email to customer with the invoice pdf attached
                if(env('MAIL_USERNAME') != null){
                    try {
                        Mail::to($request->session()->get('pos.shipping_info')['email'])->queue(new InvoiceEmailManager($array));
                        Mail::to(User::where('user_type', 'admin')->first()->email)->queue(new InvoiceEmailManager($array));
                    } catch (\Exception $e) {

                    }
                }

                Session::forget('pos.shipping_info');
                Session::forget('pos.shipping');
                Session::forget('pos.discount');
                Session::forget('pos.cart');
               return array('success' => 1, 'message' => translate('Order Completed Successfully.'));
            }
            else {
                return array('success' => 0, 'message' => translate('Please input customer information.'));
            }
        }
        return array('success' => 0, 'message' => translate("Please select a product."));
    }

    public function pos_activation()
    {
        return view('backend.pos.pos_activation');
    }
}

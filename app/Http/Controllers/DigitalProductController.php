<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductTranslation;
use App\Models\ProductVariation;
use App\Models\ShopBrand;
use App\Models\ShopCategory;
use App\Models\Upload;
use App\Utility\CategoryUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DigitalProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search    = null;
        $products       = Product::orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $sort_search    = $request->search;
            $products       = $products->where('name', 'like', '%' . $sort_search . '%');
        }
        $products = $products->where('digital', 1)->paginate(10);
        // dd($products);

        return view('backend.product.digital_products.index', compact('products', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('level', 0)->where('digital', 1)->get();
        $brands = Brand::all();
        // dd($brands);   
        return view('backend.product.digital_products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $user = auth()->user();
        $product                    = new Product;
        $product->name              = $request->name;
        $product->shop_id           = $user->shop_id;
        $product->brand_id          = $request->brand_id;
        // $product->unit              = $request->unit;
        // $product->min_qty           = $request->min_qty;
        // $product->max_qty           = $request->max_qty;
        $product->photos            = $request->photos;
        $product->thumbnail_img     = $request->thumbnail_img;
        $product->description       = $request->description;
        $product->digital           = 1;

        // SEO meta
        $product->meta_title        = (!is_null($request->meta_title)) ? $request->meta_title : $product->name;
        $product->meta_description  = (!is_null($request->meta_description)) ? $request->meta_description : strip_tags($product->description);
        $product->meta_image        = (!is_null($request->meta_image)) ? $request->meta_image : $product->thumbnail_img;
        $product->slug              = Str::slug($request->name, '-') . '-' . strtolower(Str::random(5));
        $product->file_name         = $request->file;

        // tag
        $tags                       = array();
        if ($request->tags != null) {
            foreach (json_decode($request->tags) as $key => $tag) {
                array_push($tags, $tag->value);
            }
        }
        $product->tags              = implode(',', $tags);

        // lowest highest price
        if ($request->has('is_variant') && $request->has('variations')) {
            $product->lowest_price  =  min(array_column($request->variations, 'price'));
            $product->highest_price =  max(array_column($request->variations, 'price'));
        } else {
            $product->lowest_price  =  $request->price;
            $product->highest_price =  $request->price;
        }

        $product->stock             = 1;
        // discount
        $product->discount          = $request->discount;
        $product->discount_type     = $request->discount_type;
        if ($request->date_range != null) {
            $date_var               = explode(" to ", $request->date_range);
            $product->discount_start_date = strtotime($date_var[0]);
            $product->discount_end_date   = strtotime($date_var[1]);
        }
        // Club Point
        if (get_setting('club_point')) {
            $product->earn_point = $request->earn_point;
        }

        $product->save();

        // Product Translations
        $product_translation = ProductTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'product_id' => $product->id]);
        $product_translation->name = $request->name;
        $product_translation->unit = $request->unit;
        $product_translation->description = $request->description;
        $product_translation->save();

        // category
        // $product->categories()->sync($request->category_ids);

        $product_category = new ProductCategory();
        $product_category->product_id = $product->id;
        $product_category->category_id = $request->category_id;
        $product_category->save();

        $shop_category = new ShopCategory();
        $shop_category->shop_id = $user->shop_id;
        $shop_category->category_id = $request->category_id;
        $shop_category->save();

        // shop category ids
        // $shop_category_ids = [];
        // foreach ($request->category_ids ?? [] as $id) {
        //     $shop_category_ids[] = CategoryUtility::get_grand_parent_id($id);
        // }
        // $shop_category_ids =  array_merge(array_filter($shop_category_ids), $product->shop->shop_categories->pluck('category_id')->toArray());
        // $product->shop->categories()->sync($shop_category_ids);

        // shop brand
        if ($request->brand_id) {
            ShopBrand::updateOrCreate([
                'shop_id' => $product->shop_id,
                'brand_id' => $request->brand_id,
            ]);
        }
        //taxes
        $tax_data = array();
        $tax_ids = array();
        if ($request->has('taxes')) {
            foreach ($request->taxes as $key => $tax) {
                array_push($tax_data, [
                    'tax' => $tax,
                    'tax_type' => $request->tax_types[$key]
                ]);
            }
            $tax_ids = $request->tax_ids;
        }
        $taxes = array_combine($tax_ids, $tax_data);

        $product->product_taxes()->sync($taxes);
        //product variation
        $product->is_variant        = ($request->has('is_variant') && $request->has('variations')) ? 1 : 0;

        $variation              = new ProductVariation();
        $variation->product_id  = $product->id;
        $variation->sku         = $request->sku;
        $variation->price       = $request->price;
        // $variation->stock       = $request->stock;
        $variation->save();

        $product->save();

        flash(translate('Product has been inserted successfully'))->success();
        return redirect()->route('digitalproducts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::where('digital', 1)->get();
        $selected_category = Category::find((ProductCategory::where('product_id',$product->id)->first())->category_id);
        return view('backend.product.digital_products.edit', compact('product', 'categories','selected_category'));
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
        // dd($request->all());
        $user = auth()->user();
        $product                    = Product::findOrFail($id);
        $product->name              = $request->name;
        $product->shop_id           = $user->shop_id;
        $product->brand_id          = $request->brand_id;
        // $product->unit              = $request->unit;
        // $product->min_qty           = $request->min_qty;
        // $product->max_qty           = $request->max_qty;
        $product->photos            = $request->photos;
        $product->thumbnail_img     = $request->thumbnail_img;
        $product->description       = $request->description;
        $product->digital           = 1;

        // SEO meta
        $product->meta_title        = (!is_null($request->meta_title)) ? $request->meta_title : $product->name;
        $product->meta_description  = (!is_null($request->meta_description)) ? $request->meta_description : strip_tags($product->description);
        $product->meta_image        = (!is_null($request->meta_image)) ? $request->meta_image : $product->thumbnail_img;
        $product->slug              = Str::slug($request->name, '-') . '-' . strtolower(Str::random(5));
        $product->file_name         = $request->file;

        // tag
        $tags                       = array();
        if ($request->tags != null) {
            foreach (json_decode($request->tags) as $key => $tag) {
                array_push($tags, $tag->value);
            }
        }
        $product->tags              = implode(',', $tags);

        // lowest highest price
        if ($request->has('is_variant') && $request->has('variations')) {
            $product->lowest_price  =  min(array_column($request->variations, 'price'));
            $product->highest_price =  max(array_column($request->variations, 'price'));
        } else {
            $product->lowest_price  =  $request->price;
            $product->highest_price =  $request->price;
        }

        $product->stock             = 1;
        // discount
        $product->discount          = $request->discount;
        $product->discount_type     = $request->discount_type;
        if ($request->date_range != null) {
            $date_var               = explode(" to ", $request->date_range);
            $product->discount_start_date = strtotime($date_var[0]);
            $product->discount_end_date   = strtotime($date_var[1]);
        }
        // Club Point
        if (get_setting('club_point')) {
            $product->earn_point = $request->earn_point;
        }

        $product->save();

        // Product Translations
        $product_translation = ProductTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'product_id' => $product->id]);
        $product_translation->name = $request->name;
        $product_translation->unit = $request->unit;
        $product_translation->description = $request->description;
        $product_translation->save();

        // category
        // $product->categories()->sync($request->category_ids);

        // shop category ids
        $product_category =  ProductCategory::where('product_id', $product->id)->first();
        if ($product_category) {
            $product_category->category_id = $request->category_id;
            $product_category->save();
        }

        $shop_category =  ShopCategory::where('shop_id', $user->shop_id)->first();
        if ($shop_category) {
            $shop_category->category_id = $request->category_id;
            $shop_category->save();
        }
        //  $shop_category_ids = [];
        //  foreach ($request->category_ids ?? [] as $id) {
        //      $shop_category_ids[] = CategoryUtility::get_grand_parent_id($id);
        //  }
        //  $shop_category_ids =  array_merge(array_filter($shop_category_ids), $product->shop->shop_categories->pluck('category_id')->toArray());
        //  $product->shop->categories()->sync($shop_category_ids);

        // shop brand
        if ($request->brand_id) {
            ShopBrand::updateOrCreate([
                'shop_id' => $product->shop_id,
                'brand_id' => $request->brand_id,
            ]);
        }
        //taxes
        $tax_data = array();
        $tax_ids = array();
        if ($request->has('taxes')) {
            foreach ($request->taxes as $key => $tax) {
                array_push($tax_data, [
                    'tax' => $tax,
                    'tax_type' => $request->tax_types[$key]
                ]);
            }
            $tax_ids = $request->tax_ids;
        }
        $taxes = array_combine($tax_ids, $tax_data);

        $product->product_taxes()->sync($taxes);
        //product variation
        $product->is_variant        = ($request->has('is_variant') && $request->has('variations')) ? 1 : 0;

        $variation              = ProductVariation::where('product_id', $product->id)->first();
        //  dd($variation);
        $variation->product_id  = $product->id;
        $variation->sku         = $request->sku;
        $variation->price       = $request->price;
        // $variation->stock       = $request->stock;
        $variation->save();

        $product->save();

        flash(translate('Product has been updated successfully'))->success();
        return redirect()->route('digitalproducts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->product_translations()->delete();
        $product->product_categories()->delete();
        $product->reviews()->delete();
        $product->variation_combinations()->delete();
        $product->variations()->delete();
        $product->attribute_values()->delete();
        $product->carts()->delete();
        $product->wishlists()->delete();

        Product::destroy($id);
        
        flash(translate('Product has been deleted successfully'))->success();
        return redirect()->route('digitalproducts.index');
    }
    public function download(Request $request)
    {
        $product = Product::findOrFail(decrypt($request->id));

        $upload = Upload::findOrFail($product->file_name);
        if (env('FILESYSTEM_DRIVER') == "s3") {
            return \Storage::disk('s3')->download($upload->file_name, $upload->file_original_name . "." . $upload->extension);
        } else {
            if (file_exists(base_path('public/' . $upload->file_name))) {
                return response()->download(base_path('public/' . $upload->file_name));
            }
        }
    }
}

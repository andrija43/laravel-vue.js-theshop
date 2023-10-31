<?php

namespace App\Http\Resources;

use App\Models\ProductVariationCombination;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PosProductCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                $product_variation_combination = null;
                if($data->product_variation_combination_id){
                    $product_variation_combination = ProductVariationCombination::find($data->product_variation_combination_id);
                }
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'thumbnail_image' => ($data->thumbnail_img != null)  ? uploaded_asset($data->thumbnail_img) : uploaded_asset($data->stock_image),

                    'base_price' => $data->product_variation_combination_id ? single_price(variation_price($product_variation_combination->variation->product, $product_variation_combination->variation)) : single_price(variation_price($data->variations[0]->product, $data->variations[0])),

                    'price' => $data->product_variation_combination_id ? single_price(variation_discounted_price($product_variation_combination->variation->product, $product_variation_combination->variation)) : single_price(variation_discounted_price($data->variations[0]->product, $data->variations[0])),
                    
                    'qty' => $data->stock,
                    'variant' => $data->attribute_value_name,
                    'variation_id' => $data->product_variation_combination_id ? null : $data->variations[0]->id,
                    'product_variation_combination_id' => $data->product_variation_combination_id,
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}

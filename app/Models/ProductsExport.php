<?php

namespace App\Models;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return Product::leftJoin('product_variations', 'product_variations.product_id', '=', 'products.id')->leftJoin('product_categories', 'product_categories.product_id', '=', 'products.id')->get();
        // return Product::with('product_categories')->get();
    }

    public function headings(): array
    {
        return [
            'name',
            'slug',
            'description',
            'shop_id',
            'category_id',
            'brand_id',
            'price',
            'lowest_price',
            'highest_price',
            'stock',
            'sku',
            'thumbnail_img',
            'photos',
            'meta_title',
            'meta_description',
        ];
    }

    /**
     * @var Product $product
     */
    public function map($product): array
    {
        // dd($product);
        $qty = 0;
        foreach ($product->variations as $key => $variation) {
            $qty += $variation->qty;
        }
        return [
            $product->name,
            $product->slug,
            $product->description,
            $product->shop_id,
            $product->category_id,
            $product->brand_id,
            $product->price,
            $product->lowest_price,
            $product->highest_price,
            $product->stock,
            $product->sku,
            // $product->thumbnail_img,
            api_asset($product->thumbnail_img),
            $this->convertPhotos($product->photos),
            $product->meta_title,
            $product->meta_description,
        ];
    }

    protected function convertPhotos($photos)
    {
        $result = array();
        foreach (explode(',', $photos) as $item) {
            array_push($result, api_asset($item));
        }
        return $result;
    }
}

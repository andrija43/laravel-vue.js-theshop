<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductStock;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;
use Auth;
use Carbon\Carbon;
use Storage;

//class ProductsImport implements ToModel, WithHeadingRow, WithValidation
class ProductsImport implements ToCollection, WithHeadingRow, WithValidation, ToModel
{
    private $rows = 0;

    public function collection(Collection $rows)
    {
        $canImport = true;
        $user = Auth::user();
        if ($user->user_type == 'seller' && addon_is_activated('seller_subscription')) {
            if ((count($rows) + $user->products()->count()) > $user->shop->product_upload_limit
                || $user->shop->package_invalid_at == null
                || Carbon::now()->diffInDays(Carbon::parse($user->shop->package_invalid_at), false) < 0
            ) {
                $canImport = false;
                flash(translate('Please upgrade your package.'))->warning();
            }
        }

        if ($canImport) {
            foreach ($rows as $row) {


                $productId = Product::create([

                    'name' => $row['name'],
                    'description' => $row['description'],
                    'shop_id' => $row['shop_id'],
                    'brand_id' => $row['brand_id'],
                    'lowest_price' => $row['price'],
                    'highest_price' => $row['price'],
                    'meta_title' => $row['meta_title'],
                    'meta_description' => $row['meta_description'],
                    'slug' => preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($row['slug']))) . '-' . Str::random(5),
                    

                ]);
                ProductCategory::create([
                    'product_id' => $productId->id,
                    'category_id' => $row['category_id'],
                ]);
                ProductVariation::create([
                    'product_id' => $productId->id,
                    'stock' => $row['stock'],
                    'sku' => $row['sku'],
                    'price' => $row['price'],
                ]);
            }

            flash(translate('Products imported successfully'))->success();
        }
    }

    public function model(array $row)
    {
        ++$this->rows;
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }

    public function rules(): array
    {
        return [
            // Can also use callback validation rules
            'price' => function ($attribute, $value, $onFailure) {
                if (!is_numeric($value)) {
                    $onFailure('Unit price is not numeric');
                }
            }
        ];
    }

    public function downloadThumbnail($url)
    {
        try {
            $upload = new Upload;
            $upload->external_link = $url;
            $upload->type = 'image';
            $upload->save();

            return $upload->id;
        } catch (\Exception $e) {
        }
        return null;
    }

    public function downloadGalleryImages($urls)
    {
        $data = array();
        foreach (explode(',', str_replace(' ', '', $urls)) as $url) {
            $data[] = $this->downloadThumbnail($url);
        }
        return implode(',', $data);
    }
}

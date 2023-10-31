<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BlogCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => $data->id,
                    'category' => $data->category->getTranslation('name'),
                    'title' => $data->getTranslation('title'),
                    'short_description' => $data->getTranslation('short_description'),
                    'banner' => api_asset($data->banner),
                    'slug' => $data->slug, 
                    'created_at' => date('F j, Y', strtotime($data->created_at)),
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

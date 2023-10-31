<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogSingleCollection extends JsonResource
{   
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category' => $this->category->getTranslation('name'),
            'title' => $this->getTranslation('title'),
            'short_description' => $this->getTranslation('short_description'),
            'description' => $this->getTranslation('description'),
            'banner' => api_asset($this->banner),
            'slug' => $this->slug,
            'meta_title' => $this->meta_title,
            'meta_img' => $this->meta_img,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'created_at' => date('F j, Y', strtotime($this->created_at)),
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }

    protected function convertPhotos(){
        $result = array();
        foreach (explode(',', $this->photos) as $item) {
            array_push($result, api_asset($item));
        }
        return $result;
    }
}

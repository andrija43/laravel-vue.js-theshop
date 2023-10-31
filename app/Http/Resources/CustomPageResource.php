<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomPageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (integer) $this->id,
            'type' => $this->type,
            'title' => $this->getTranslation('title'),
            'slug' => $this->slug,
            'content' => $this->getTranslation('content'),
            'metaTitle' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'keywords' => $this->keywords,
            'meta_image' => api_asset($this->meta_image),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
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

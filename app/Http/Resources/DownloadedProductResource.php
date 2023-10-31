<?php

namespace App\Http\Resources;

use App\Models\Upload;
use Illuminate\Http\Resources\Json\JsonResource;

class DownloadedProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $upload = Upload::findOrFail($this->file_name);
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'image'=>api_asset($this->thumbnail_img),
            'file_path'=> "http://".$_SERVER['HTTP_HOST'].'/'.'public/'. $upload->file_name,
            // 'file_path'=> base_path('public/' . $upload->file_name),
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

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClubPointResource extends JsonResource
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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'points' => $this->points,
            'convert_status' => (int) $this->convert_status,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
            'order_code' =>$this->combined_order->code,
        ];
    } 
}

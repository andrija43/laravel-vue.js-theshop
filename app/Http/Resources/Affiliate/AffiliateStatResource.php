<?php

namespace App\Http\Resources\Affiliate;

use Illuminate\Http\Resources\Json\JsonResource;

class AffiliateStatResource extends JsonResource
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
            'click' => $this->click,
            'item' => $this->item,
            'delivered' => $this->delivered,
            'cancel' => $this->cancel
        ];
    }
}

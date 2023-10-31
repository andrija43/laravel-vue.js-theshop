<?php

namespace App\Http\Resources\Affiliate;

use Illuminate\Http\Resources\Json\JsonResource;

class EarningHistoryResource extends JsonResource
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
            'referral_user'=> $this->user->name,
            'amount'=> $this->amount,
            'order_id'=> $this->order_id != null ? optional($this->order)->code : optional($this->order_detail->order)->code,
            'referrel_type'=> $this->affiliate_type,
            'product'=> $this->order_detail->product->name,
            'date'=> $this->created_at->format('d-m-Y'),
        ];
    }
}

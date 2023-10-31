<?php

namespace App\Http\Resources\Affiliate;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentHistoryResource extends JsonResource
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
            'amount' => $this->amount,
            'date' => $this->created_at->format('d-M-Y'),
            'payment_method' => $this->payment_method,
        ];
    }
}

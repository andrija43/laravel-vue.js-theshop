<?php

namespace App\Http\Resources\Affiliate;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class WithDrawRequestResource extends JsonResource
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
            'status' => $this->status,
        ];
    }
}

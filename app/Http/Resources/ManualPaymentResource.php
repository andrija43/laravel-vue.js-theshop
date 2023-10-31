<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Str;

class ManualPaymentResource extends JsonResource
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
            'id'            => $this->id,
            'code'          => "offline_payment-".$this->id,
            'type'          => $this->type,
            'type_show'     => Str::replace('_', ' ', $this->type),
            'name'          => $this->heading,
            'heading'       => $this->heading,
            'description'   => $this->description,
            'bank_info'     => $this->bank_info ? json_decode($this->bank_info): [],
            'img'           => uploaded_asset($this->photo)
        ];
    }
}

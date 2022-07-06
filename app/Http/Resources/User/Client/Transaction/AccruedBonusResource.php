<?php

namespace App\Http\Resources\User\Client\Transaction;

use Illuminate\Http\Resources\Json\JsonResource;

class AccruedBonusResource extends JsonResource
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
            "bonus_amount" => (int) (($this->purchase_amount * $this->bonus_amount) / 100),
            "purchase_amount" => $this->purchase_amount,
            "bonus_percent" => $this->bonus_amount,
            "created_at" => date('Y-m-d H:i', strtotime($this->created_at))
        ];
    }
}

<?php

namespace App\Http\Resources\User\Business\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;

class InfoResource extends JsonResource
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
            'purchase_amount' => $this->purchase_amount,
            'bonus_amount' => $this->bonus_amount,
            'business_user' => [
                'id' => $this->businessUser->id,
                'name' => $this->businessUser->name,
            ],
            'client_user' => [
                'id' => $this->clientUser->id,
                'name' => $this->clientUser->name,
                'phone_number' => $this->clientUser->phone_number,
            ]
        ];
    }
}

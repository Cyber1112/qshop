<?php

namespace App\Http\Resources\User\Business\Account;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            "name" => $this->name,
            "business_name" => $this->business->business_name,
            "images" => $this->images[0]->filename,
            "phone_number" => $this->phone_number,
            "balance" => $this->business->balance,
        ];
    }
}

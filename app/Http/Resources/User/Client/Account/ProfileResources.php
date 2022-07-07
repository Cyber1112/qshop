<?php

namespace App\Http\Resources\User\Client\Account;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var User $this */
        return [
            "name" => $this->name,
            "images" => $this->images[0]->filename ?? null,
            "phone_number" => $this->phone_number,
        ];
    }
}

<?php

namespace App\Http\Resources\User\Employee\Account;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Employee;

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
        /** @var Employee $this */
        return [
            "id" => $this->user->id,
            "phone_number" => $this->user->phone_number,
            "name" => $this->user->name,
            "position" => $this->position,
            "business_name" => $this->business->business_name,
            "business_balance" => $this->business->balance,
            "permissions" => $this->user->getPermissionNames()
        ];
    }
}

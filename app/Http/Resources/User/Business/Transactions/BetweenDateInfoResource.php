<?php

namespace App\Http\Resources\User\Business\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;

class BetweenDateInfoResource extends JsonResource
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
            'transactions' => $this->getTotalSum
        ];
    }
}

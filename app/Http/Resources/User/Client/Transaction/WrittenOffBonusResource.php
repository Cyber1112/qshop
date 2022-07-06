<?php

namespace App\Http\Resources\User\Client\Transaction;

use Illuminate\Http\Resources\Json\JsonResource;

class WrittenOffBonusResource extends JsonResource
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
            "written_off_bonus" => $this->written_off_bonus,
            "created_at" => date('Y-m-d H:i', strtotime($this->created_at))
        ];
    }
}

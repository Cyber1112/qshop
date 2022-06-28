<?php

namespace App\Http\Resources\City;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AllResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var City $this */

        return [
            'id' => $this->id,
            'name' => $this->city,
        ];
    }
}

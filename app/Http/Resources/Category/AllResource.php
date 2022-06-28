<?php

namespace App\Http\Resources\Category;

use App\Models\Category;
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
        /** @var Category $this */

        return [
            'id' => $this->id,
            'name' => $this->city,
        ];
    }
}

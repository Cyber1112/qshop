<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return AnonymousResourceCollection
     */
    public function toArray($request): AnonymousResourceCollection
    {
        return AllResource::collection($this->collection);
    }
}

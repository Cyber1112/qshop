<?php

namespace App\Http\Resources\User\Business\CompanyInformation;

use App\Models\Business;
use Illuminate\Http\Resources\Json\JsonResource;

class InfoResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Business $this */
        return [
            'contacts' => $this->contact,
            'city' => $this->city,
            'description' => $this->description,
            'categories' => $this->category,
            'schedule' => $this->schedule,
        ];
    }
}

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
            'contacts' => [
                'address' => $this->contact->address,
                'phone_number' => $this->contact->phone_number,
                'site_location' => $this->contact->site_location
            ],
            'city' => $this->city[0]->city,
            'description' => $this->description->description,
            'categories' => $this->category->pluck('category_name')->toArray(),
            'schedule' => [
                'work_schedule' => $this->schedule->work_schedule,
                'work_start' => $this->schedule->work_start,
                'work_end' => $this->schedule->work_end,
            ]
        ];
    }
}

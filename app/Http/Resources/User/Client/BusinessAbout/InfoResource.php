<?php

namespace App\Http\Resources\User\Client\BusinessAbout;

use App\Models\Business;
use Illuminate\Http\Resources\Json\JsonResource;

class InfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Business $this */

        return [
            'business_name' => $this->business_name,
            'phone_number' => $this->user->phone_number,
            'cashback' => $this->bonus->bonus_amount,
            'description' => $this->description->description,
            'categories' => $this->category->pluck('category_name')->toArray(),
            'contacts' => [
                'address' => $this->contact->address,
                'phone_number' => $this->contact->phone_number,
                'site_location' => $this->contact->site_location,
            ],
            'schedule' => [
                'work_schedule' => $this->schedule->work_schedule,
                'work_start' => $this->schedule->work_start,
                'work_end' => $this->schedule->work_end,
            ],
            'bonus_amount' => $this->getClientBonus() ?? null
        ];
    }
}

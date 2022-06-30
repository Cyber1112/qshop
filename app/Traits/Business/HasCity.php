<?php

namespace App\Traits\Business;

use App\Models\City;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasCity{

    public function city(): BelongsToMany
    {
        return $this->belongsToMany(City::class, 'business_cities', 'business_id', 'city_id');
    }

}

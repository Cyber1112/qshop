<?php

namespace App\Traits\Business;

use App\Models\BusinessSchedule;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasSchedule{

    public function schedule(): HasMany
    {
        return $this->hasMany(BusinessSchedule::class);
    }

}

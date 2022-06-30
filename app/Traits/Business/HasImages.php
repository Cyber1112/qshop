<?php

namespace App\Traits\Business;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasImages{

    public function images(): MorphMany
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

}

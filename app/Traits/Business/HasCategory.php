<?php

namespace App\Traits\Business;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasCategory{

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(SubCategory::class, 'business_categories', 'business_id', 'category_id');
    }

}

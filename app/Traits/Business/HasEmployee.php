<?php

namespace App\Traits\Business;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasEmployee{

    public function employee(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

}

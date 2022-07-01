<?php

namespace App\Traits\Client;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasUser{

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}

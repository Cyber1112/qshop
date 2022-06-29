<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusinessBonusOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'bonus_amount',
        'activation_bonus_period',
        'deactivation_bonus_period',
        'business_id'
    ];

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

}

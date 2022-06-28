<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessCity extends Model
{
    use HasFactory;

    public $table = "business_cities";

    protected $fillable = [
        'business_id',
        'city_id',
    ];

    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'phone_number',
        'site_location',
        'business_id'
    ];

    public function business(){
        return $this->belongsTo(Business::class);
    }
}

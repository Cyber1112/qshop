<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessDescription extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'business_id'
    ];

    public function business(){
        return $this->belongsTo(Business::class);
    }

}

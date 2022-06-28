<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'category_id'
    ];

    public function business() {
        return $this->belongsToMany(Business::class, 'business_categories', 'category_id', 'business_id');
    }
}

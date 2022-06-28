<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'balance',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function employee(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function contact(): HasOne
    {
        return $this->hasOne(Contact::class);
    }

    public function description(): HasOne
    {
        return $this->hasOne(BusinessDescription::class);
    }

    public function city(): BelongsToMany
    {
        return $this->belongsToMany(City::class, 'business_cities', 'business_id', 'city_id');
    }

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(SubCategory::class, 'business_categories', 'business_id', 'category_id');
    }
    public function schedule(): HasMany
    {
        return $this->hasMany(BusinessSchedule::class);
    }
    public function images(){
        return $this->morphMany('App\Models\Image', 'imageable');
    }


}


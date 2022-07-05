<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Znck\Eloquent\Traits\BelongsToThrough;


/**
 * @property int $quantity Количество
 */
class TransactionHistory extends Model
{
    use HasFactory, BelongsToThrough;

    protected $fillable = [
        'bonus_amount',
        'purchase_amount',
        'business_id',
        'client_id'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TransactionComment::class);
    }

    public function clientUser(){
        return $this->belongsToThrough(User::class, Client::class);
    }
    public function businessUser(){
        return $this->belongsToThrough(User::class, Business::class);
    }

    public function getTotalSum($id){
        $this::where('id', $id)->sum('purchase_amount');
    }

}

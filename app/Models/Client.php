<?php

namespace App\Models;

use App\Traits\Client\HasTransactions;
use App\Traits\Client\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory, HasUser, HasTransactions;

    protected $fillable = [
        'user_id'
    ];

    public function businessBonus(){
        return $this->belongsToMany(Business::class,'business_client_bonuses', 'client_id', 'business_id');
    }


}

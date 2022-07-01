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
        'balance',
        'user_id'
    ];


}

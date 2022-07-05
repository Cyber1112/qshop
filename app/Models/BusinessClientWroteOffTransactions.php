<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessClientWroteOffTransactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'written_off_bonus',
        'business_id',
        'client_id'
    ];
}

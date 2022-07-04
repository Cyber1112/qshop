<?php

namespace App\Models;

use App\Traits\Business\HasBonus;
use App\Traits\Business\HasCategory;
use App\Traits\Business\HasCity;
use App\Traits\Business\HasContact;
use App\Traits\Business\HasDescription;
use App\Traits\Business\HasEmployee;
use App\Traits\Business\HasImages;
use App\Traits\Business\HasSchedule;
use App\Traits\Business\HasTransactions;
use App\Traits\Business\HasUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static Builder|Business query()
 */
class Business extends Model
{
    use HasFactory, HasUser, HasDescription,
        HasContact, HasCity, HasSchedule,
        HasCategory, HasBonus, HasEmployee,
        HasImages, HasTransactions;

    protected $fillable = [
        'business_name',
        'balance',
        'user_id'
    ];

    public function clientBonus(){
        return $this->belongsToMany(Client::class, 'business_client_bonuses', 'business_id', 'client_id');
    }


}


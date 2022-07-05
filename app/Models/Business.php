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
use Spatie\Permission\Traits\HasRoles;

/**
 * @method static Builder|Business query()
 */
class Business extends Model
{
    use HasFactory, HasRoles, HasUser, HasDescription,
        HasContact, HasCity, HasSchedule,
        HasCategory, HasBonus, HasEmployee,
        HasImages, HasTransactions;

    protected $guard_name = 'web';

    protected $fillable = [
        'business_name',
        'balance',
        'user_id'
    ];

    public function clientBonus(){
        return $this->belongsToMany(Client::class, 'business_client_bonuses', 'business_id', 'client_id');
    }

    public function transactionHistory(){
        return $this->hasMany(TransactionHistory::class);
    }

    public function businessClientWrittenOffTransactions(){
        return $this->belongsToMany(Client::class, 'business_client_wrote_off_transactions', 'business_id', 'client_id');
    }

}


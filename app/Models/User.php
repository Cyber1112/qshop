<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\User\HasBusinesses;
use App\Traits\User\HasClients;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
/**
 * App\Models\User
 *
 * @property-read Business|null $business
 * @method static Builder|User query()
 */

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasBusinesses, HasClients;
    protected $guard_name = 'web';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone_number',
        'image_path',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    protected $casts = [
        'phone_verified_at' => 'datetime',
    ];

    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class);
    }

    public function images(){
        return $this->morphMany('App\Models\Image', 'imageable');
    }

}

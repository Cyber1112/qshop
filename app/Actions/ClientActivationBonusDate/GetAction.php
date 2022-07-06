<?php

namespace App\Actions\ClientActivationBonusDate;

use App\Contracts\GetClientActivationBonusDate;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Helpers;
use Illuminate\Support\Facades\Auth;
use App\Tasks;

class GetAction implements GetClientActivationBonusDate{

    protected $user;

    public function __construct(){
        $this->user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(): Collection
    {
        $data = app(Tasks\BusinessClientBonus\GetClientPartnersTask::class)->run(
            $this->user,
            ['businesses.business_name', 'business_client_bonuses.balance', 'business_client_bonuses.activation_bonus_date']
        );

        $filtered_data = $data->filter(function ($value){
            return $value['activation_bonus_date'] > Carbon::now()->toDateTimeString();
        })->values();

        return $filtered_data;
    }

}

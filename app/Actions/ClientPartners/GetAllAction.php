<?php

namespace App\Actions\ClientPartners;

use App\Contracts\GetClientPartners;
use Illuminate\Support\Collection;
use App\Tasks;
use App\Helpers;
use Illuminate\Support\Facades\Auth;

class GetAllAction implements GetClientPartners{

    public function execute(): Collection
    {
        $user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());

        $data = app(Tasks\BusinessClientBonus\GetClientPartnersTask::class)->run(
            $user,
            ['businesses.business_name', 'business_client_bonuses.balance']
        );

        return $this->groupData($data);
    }

    public function groupData($data){

        return $data->groupBy('business_name')->map(function ($row){
            return $row->sum('balance');
        });

    }

}

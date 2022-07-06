<?php

namespace App\Actions\ClientPartners;

use App\Contracts\GetClientFullInfo;
use Illuminate\Support\Collection;
use App\Helpers;
use App\Tasks;
use Illuminate\Support\Facades\Auth;

class GetFullInfoAction implements GetClientFullInfo{

    public $user;

    public function __construct(){
        $this->user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(): Collection
    {
        return collect([
            'total_bonus' => $this->getTotalBonus(),
            'saved_money' => $this->getSavedMoney(),
            'total_transactions' => $this->getTotalTransactions(),
            'total_partners' => $this->getTotalPartners(),
            'unactivated_bonus' => $this->getUnActivatedBonus()
        ]);
    }

    public function getTotalBonus(): int
    {
        return app(Tasks\BusinessClientBonus\GetClientTotalBonusTask::class)->run($this->user);
    }

    public function getSavedMoney(): int
    {
        return app(Tasks\BusinessClientWrittenOffTransaction\GetWrittenOffBonusByClientTask::class)->run($this->user);
    }

    public function getTotalTransactions(): int
    {
        return app(Tasks\TransactionHistory\GetTotalTransactionsByClientTask::class)->run($this->user);
    }

    public function getTotalPartners(): int
    {
        $data = app(Tasks\TransactionHistory\GetTotalClientPartnersTask::class)->run($this->user);
        return $data->groupBy('business_id')->count();
    }

    public function getUnActivatedBonus(): int
    {
        return app(Tasks\BusinessClientBonus\GetClientUnActivatedBonus::class)->run($this->user);
    }
}

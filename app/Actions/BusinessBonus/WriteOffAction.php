<?php

namespace App\Actions\BusinessBonus;

use App\Contracts\WriteOffBonusFromClient;
use App\Tasks;

class WriteOffAction implements WriteOffBonusFromClient {


    public function execute(int $client_id, int $bonus_amount): void
    {
        $this->writeOffBonus($client_id, $bonus_amount);
    }

    public function writeOffBonus($client_id, $bonus_amount){
        app(Tasks\Client\DecrementBonusTask::class)->run($client_id, $bonus_amount);
    }

}

<?php

namespace App\Actions\BusinessBonus;

use App\Contracts\BusinessBonus;
use App\Tasks;

class CreateAction implements BusinessBonus{

    public function execute(int $business_id, int $bonus_amount, int $activation_bonus_period = 0, int $deactivation_bonus_period = null): void
    {
        $this->delete($business_id);

        app(Tasks\BusinessBonusOption\CreateTask::class)->run(
            [
                'bonus_amount' => $bonus_amount,
                'activation_bonus_period' => $activation_bonus_period,
                'deactivation_bonus_period' => $deactivation_bonus_period,
                'business_id' => $business_id,
            ]
        );

    }
    public function delete($business_id){
        app(Tasks\BusinessBonusOption\DeleteTask::class)->run($business_id);
    }
}

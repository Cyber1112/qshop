<?php

namespace App\Contracts;

interface BusinessBonus{

    /**
     * @param int $business_id
     * @param int $bonus_amount
     * @param int $activation_bonus_period
     * @param int|null $deactivation_bonus_period
     * @return void
     */
    public function execute(
        int $business_id,
        int $bonus_amount,
        int $activation_bonus_period = 0,
        int $deactivation_bonus_period = null
    ): void;

}

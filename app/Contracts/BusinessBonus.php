<?php

namespace App\Contracts;

use App\Dto\BusinessBonus\CreateDto;

interface BusinessBonus{

    /**
     * @param int $business_id
     * @param CreateDto $dto
     * @return void
     */
    public function execute(
        int $business_id,
        CreateDto $dto
    ): void;

}

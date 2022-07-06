<?php

namespace App\Contracts;

use App\Dto\BusinessBonus\CreateDto;

interface BusinessBonus{

    /**
     * @param CreateDto $dto
     * @return void
     */
    public function execute(
        CreateDto $dto
    ): void;

}

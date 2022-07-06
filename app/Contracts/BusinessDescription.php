<?php

namespace App\Contracts;

use App\Dto\BusinessDescription\CreateDto;

interface BusinessDescription{

    /**
     * @param CreateDto $dto
     * @return void
     */
    public function execute(CreateDto $dto): void;

}

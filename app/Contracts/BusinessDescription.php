<?php

namespace App\Contracts;

use App\Dto\BusinessDescription\CreateDto;

interface BusinessDescription{

    /**
     * @param CreateDto $dto
     * * @param int $id
     * @return void
     */
    public function execute(CreateDto $dto, $id): void;

}

<?php

namespace App\Contracts;

use App\Dto\BusinessContact\CreateDto;

interface ContactInformation{

    /**
     *
     * @param CreateDto $dto
     * @return void
     */
    public function execute(CreateDto $dto): void;

}

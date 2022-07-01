<?php

namespace App\Contracts;

use App\Dto\BusinessTransaction\CreateDto;

interface Transaction{

    /**
     * @param CreateDto $dto
     * @return void
     */
    public function execute(CreateDto $dto, int $business_id, int $client_id): void;

}

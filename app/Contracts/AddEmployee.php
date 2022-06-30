<?php

namespace App\Contracts;

use App\Dto\BusinessEmployee\CreateDto;

interface AddEmployee{

    public function execute(
        CreateDto $dto,
        int $business_id
    ): void;

}

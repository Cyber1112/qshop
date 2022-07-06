<?php

namespace App\Contracts;

use App\Dto\BusinessEmployee\CreateDto;

interface AddEmployee{

    public function execute(CreateDto $dto): void;

}

<?php

namespace App\Contracts;

interface AddEmployee{

    public function execute(
        string $phone_number,
        string $name,
        string $position,
        string $password,
        array $permissions
    ): void;

}

<?php

namespace App\Contracts;

interface DeleteEmployee{

    public function execute($employee_id): void;

}

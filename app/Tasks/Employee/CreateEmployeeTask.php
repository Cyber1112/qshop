<?php

namespace App\Tasks\Employee;

use App\Repositories\EmployeeRepositoryInterface;

class CreateEmployeeTask{

    private EmployeeRepositoryInterface $employee_repository;

    public function __construct(EmployeeRepositoryInterface $employee_repository){
        $this->employee_repository = $employee_repository;
    }

    public function run(array $payload){
        $this->employee_repository->create($payload);
    }

}

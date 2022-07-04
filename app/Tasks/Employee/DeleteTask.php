<?php

namespace App\Tasks\Employee;

use App\Repositories\EmployeeRepositoryInterface;

class DeleteTask{

    private EmployeeRepositoryInterface $employee_repository;

    public function __construct(EmployeeRepositoryInterface $employee_repository){
        $this->employee_repository = $employee_repository;
    }

    public function run(int $employee_id){
        $this->employee_repository->deleteEmployee($employee_id);
    }

}

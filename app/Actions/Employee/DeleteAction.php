<?php

namespace App\Actions\Employee;

use App\Contracts\DeleteEmployee;
use App\Tasks;

class DeleteAction implements DeleteEmployee {

    public function execute($employee_id): void
    {
        app(Tasks\Employee\DeleteTask::class)->run($employee_id);
    }
}

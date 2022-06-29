<?php

namespace App\Repositories\Eloquent;


use App\Models\Employee;
use App\Repositories\EmployeeRepositoryInterface;

class EmployeeRepository extends BaseRepository implements EmployeeRepositoryInterface{

    public function __construct(Employee $model){
        $this->model = $model;
    }

    public function findByUserId(
        int $user_id,
        array $columns = ['*'],
        array $relations = [],
        array $relations_count = []
    ): ?Employee
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('user_id', $user_id)
            ->with($relations)
            ->withCount($relations_count)
            ->first();
    }

}

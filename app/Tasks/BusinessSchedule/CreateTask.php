<?php

namespace App\Tasks\BusinessSchedule;

use App\Repositories\BusinessScheduleRepositoryInterface;

class CreateTask{

    private BusinessScheduleRepositoryInterface $business_schedule_repository;

    public function __construct(BusinessScheduleRepositoryInterface $business_schedule_repository)
    {
        $this->business_schedule_repository = $business_schedule_repository;
    }

    public function run(array $payload){
        $this->business_schedule_repository->create($payload);
    }

}

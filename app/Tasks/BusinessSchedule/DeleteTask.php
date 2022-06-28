<?php

namespace App\Tasks\BusinessSchedule;

use App\Repositories\BusinessScheduleRepositoryInterface;

class DeleteTask{

    private BusinessScheduleRepositoryInterface $business_schedule_repository;

    public function __construct(BusinessScheduleRepositoryInterface $business_schedule_repository)
    {
        $this->business_schedule_repository = $business_schedule_repository;
    }

    public function run(string $business_id){
        $this->business_schedule_repository->deleteByBusinessId($business_id);
    }

}

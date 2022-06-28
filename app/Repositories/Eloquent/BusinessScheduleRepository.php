<?php

namespace App\Repositories\Eloquent;

use App\Models\BusinessSchedule;
use App\Repositories\BusinessScheduleRepositoryInterface;

class BusinessScheduleRepository extends BaseRepository implements BusinessScheduleRepositoryInterface{

    public function __construct(BusinessSchedule $model){
        $this->model = $model;
    }

    /**
     * @param string $business_id
     * @return bool|null
     */
    public function deleteByBusinessId(string $business_id): ?bool
    {
        return $this->model
            ->query()
            ->where("business_id", $business_id)
            ->delete();
    }
}

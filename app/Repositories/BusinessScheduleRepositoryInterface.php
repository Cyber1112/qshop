<?php

namespace App\Repositories;

interface BusinessScheduleRepositoryInterface extends EloquentRepositoryInterface{

    public function deleteByBusinessId(string $business_id): ?bool;

}

<?php

namespace App\Repositories\Eloquent;

use App\Models\BusinessBonusOption;
use App\Repositories\BusinessBonusRepositoryInterface;

class BusinessBonusRepository extends BaseRepository implements BusinessBonusRepositoryInterface{

    public function __construct(BusinessBonusOption $model){
        $this->model = $model;
    }

    public function findByBusinessId(int $business_id, array $columns = ['*'], array $relations = [], array $relations_count = []): ?BusinessBonusOption
    {
        return $this->model
                ->query()
                ->select($columns)
                ->where('business_id', $business_id)
                ->with($relations)
                ->withCount($relations_count)
                ->first();
    }
}

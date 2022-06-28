<?php

namespace App\Repositories\Eloquent;

use App\Models\BusinessCity;
use App\Repositories\BusinessCityRepositoryInterface;

class BusinessCityRepository extends BaseRepository implements BusinessCityRepositoryInterface{

    /**
     * @param BusinessCity $model
     */
    public function __construct(BusinessCity $model)
    {
        $this->model = $model;
    }

}

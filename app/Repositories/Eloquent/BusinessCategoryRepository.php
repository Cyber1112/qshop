<?php

namespace App\Repositories\Eloquent;

use App\Models\Business;
use App\Models\BusinessCategory;
use App\Repositories\BusinessCategoryRepositoryInterface;

class BusinessCategoryRepository extends BaseRepository implements BusinessCategoryRepositoryInterface{

    /**
     * @param BusinessCategory $model
     */
    public function __construct(BusinessCategory $model){
        $this->model = $model;
    }
}

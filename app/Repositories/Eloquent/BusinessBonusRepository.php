<?php

namespace App\Repositories\Eloquent;

use App\Models\BusinessBonusOption;
use App\Repositories\BusinessBonusRepositoryInterface;

class BusinessBonusRepository extends BaseRepository implements BusinessBonusRepositoryInterface{

    public function __construct(BusinessBonusOption $model){
        $this->model = $model;
    }

}

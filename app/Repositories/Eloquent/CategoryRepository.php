<?php

namespace App\Repositories\Eloquent;


use App\Models\SubCategory;
use App\Repositories\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface{

    public function __construct(SubCategory $model){
        $this->model = $model;
    }

}

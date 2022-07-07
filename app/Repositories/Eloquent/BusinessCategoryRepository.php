<?php

namespace App\Repositories\Eloquent;

use App\Models\BusinessCategory;
use App\Repositories\BusinessCategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;


class BusinessCategoryRepository extends BaseRepository implements BusinessCategoryRepositoryInterface{

    /**
     * @param BusinessCategory $model
     */
    public function __construct(BusinessCategory $model){
        $this->model = $model;
    }


    public function getBusinessByCategory(int $category_id, array $columns = ['*']): Collection
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('category_id', $category_id)
            ->join('businesses', 'businesses.id', '=', 'business_id')
            ->join('business_bonus_options', 'business_bonus_options.business_id', '=', 'businesses.id')
            ->get();

    }
}

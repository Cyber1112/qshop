<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;

interface BusinessCategoryRepositoryInterface extends EloquentRepositoryInterface{

    public function getBusinessByCategory(int $category_id, array $columns = ['*']): Collection;

}

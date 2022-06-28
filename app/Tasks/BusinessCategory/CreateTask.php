<?php

namespace App\Tasks\BusinessCategory;

use App\Repositories\BusinessCategoryRepositoryInterface;

class CreateTask{

    private BusinessCategoryRepositoryInterface $business_category_repository;

    public function __construct(BusinessCategoryRepositoryInterface $business_category_repository){
        $this->business_category_repository = $business_category_repository;
    }

    public function run(array $payload){
        $this->business_category_repository->create($payload);
    }

}

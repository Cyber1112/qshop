<?php

namespace App\Tasks\Business;

use App\Repositories\BusinessRepositoryInterface;

class GetBusinessBonusOptions{

    private BusinessRepositoryInterface $business_repository;

    public function __construct(BusinessRepositoryInterface $business_repository){
        $this->business_repository = $business_repository;
    }

    public function run(array $columns = ['*']){
        return $this->business_repository->getBusinessBonusOptions($columns);
    }
}

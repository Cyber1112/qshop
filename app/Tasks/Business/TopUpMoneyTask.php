<?php

namespace App\Tasks\Business;

use App\Repositories\BusinessRepositoryInterface;

class TopUpMoneyTask{

    private BusinessRepositoryInterface $business_repository;

    public function __construct(BusinessRepositoryInterface $business_repository){
        $this->business_repository = $business_repository;
    }

    public function run($business_id, $purchase_amount){
        return $this->business_repository->incrementBalance($business_id, $purchase_amount);
    }
}

<?php

namespace App\Tasks\Business;

use App\Repositories\BusinessRepositoryInterface;

class WriteOffMoneyTask{

    private BusinessRepositoryInterface $business_repository;

    public function __construct(BusinessRepositoryInterface $business_repository){
        $this->business_repository = $business_repository;
    }

    public function run($business_id, $purchase_amount){
        return $this->business_repository->decrementBalance($business_id, $purchase_amount);
    }
}

<?php

namespace App\Tasks\Business;

use App\Repositories\BusinessRepositoryInterface;

class FindTask{

    private BusinessRepositoryInterface $business_repository;

    public function __construct(BusinessRepositoryInterface $business_repository){
        $this->business_repository = $business_repository;
    }

    public function run($id){
        return $this->business_repository->findByUserId($id);
    }
}

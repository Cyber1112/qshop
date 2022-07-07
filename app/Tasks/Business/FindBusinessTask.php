<?php

namespace App\Tasks\Business;

use App\Repositories\BusinessRepositoryInterface;

class FindBusinessTask{

    private BusinessRepositoryInterface $business_repository;

    public function __construct(BusinessRepositoryInterface $business_repository){
        $this->business_repository = $business_repository;
    }

    public function run($id){
        return $this->business_repository->find($id);
    }
}

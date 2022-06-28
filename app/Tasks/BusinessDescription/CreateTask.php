<?php

namespace App\Tasks\BusinessDescription;

use App\Repositories\BusinessDescriptionRepositoryInterface;

class CreateTask{

    private BusinessDescriptionRepositoryInterface $business_description_repository;

    public function __construct(BusinessDescriptionRepositoryInterface $business_description_repository){
        $this->business_description_repository = $business_description_repository;
    }


    public function run(array $payload){
        return $this->business_description_repository->create($payload);
    }

}

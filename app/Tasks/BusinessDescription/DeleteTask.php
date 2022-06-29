<?php

namespace App\Tasks\BusinessDescription;

use App\Repositories\BusinessDescriptionRepositoryInterface;

class DeleteTask{

    private BusinessDescriptionRepositoryInterface $business_description_repository;

    public function __construct(BusinessDescriptionRepositoryInterface $business_description_repository){
        $this->business_description_repository = $business_description_repository;
    }


    public function run($id){
        return $this->business_description_repository->deleteByBusinessId($id);
    }

}

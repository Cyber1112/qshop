<?php

namespace App\Tasks\BusinessInformation;

use App\Repositories\BusinessContactRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CreateTask{

    private BusinessContactRepositoryInterface $business_contact_repository;

    public function __construct(BusinessContactRepositoryInterface $business_contact_repository){
        $this->business_contact_repository = $business_contact_repository;
    }

    /**
     * @param array $payload
     * @return Model
     */
    public function run(array $payload){
        return $this->business_contact_repository->create($payload);
    }

}

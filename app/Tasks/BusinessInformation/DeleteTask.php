<?php

namespace App\Tasks\BusinessInformation;

use App\Repositories\BusinessContactRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class DeleteTask{

    private BusinessContactRepositoryInterface $business_contact_repository;

    public function __construct(BusinessContactRepositoryInterface $business_contact_repository){
        $this->business_contact_repository = $business_contact_repository;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function run(int $id){
        return $this->business_contact_repository->deleteByBusinessId($id);
    }

}

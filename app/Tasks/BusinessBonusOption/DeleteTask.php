<?php

namespace App\Tasks\BusinessBonusOption;

use App\Repositories\Eloquent\BusinessBonusRepository;

class DeleteTask{

    private BusinessBonusRepository $bonus_repository;

    public function __construct(BusinessBonusRepository $bonus_repository){
        $this->bonus_repository = $bonus_repository;
    }

    public function run(int $business_id){
        return $this->bonus_repository->deleteByBusinessId($business_id);
    }

}

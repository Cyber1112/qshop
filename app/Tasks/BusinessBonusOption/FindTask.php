<?php

namespace App\Tasks\BusinessBonusOption;

use App\Repositories\Eloquent\BusinessBonusRepository;

class FindTask{

    private BusinessBonusRepository $bonus_repository;

    public function __construct(BusinessBonusRepository $bonus_repository){
        $this->bonus_repository = $bonus_repository;
    }

    public function run(int $business_id){
        return $this->bonus_repository->findByBusinessId($business_id);
    }

}

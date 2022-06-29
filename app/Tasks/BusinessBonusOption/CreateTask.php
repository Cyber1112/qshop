<?php

namespace App\Tasks\BusinessBonusOption;

use App\Repositories\Eloquent\BusinessBonusRepository;

class CreateTask{

    private BusinessBonusRepository $bonus_repository;

    public function __construct(BusinessBonusRepository $bonus_repository){
        $this->bonus_repository = $bonus_repository;
    }

    public function run(array $payload){
        return $this->bonus_repository->create($payload);
    }

}

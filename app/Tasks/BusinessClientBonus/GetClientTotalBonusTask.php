<?php

namespace App\Tasks\BusinessClientBonus;

use App\Repositories\BusinessClientBonusRepositoryInterface;

class GetClientTotalBonusTask{

    private BusinessClientBonusRepositoryInterface $bonus_repository;

    public function __construct(BusinessClientBonusRepositoryInterface $bonus_repository)
    {
        $this->bonus_repository = $bonus_repository;
    }

    public function run(int $client_id){
        return $this->bonus_repository->getTotalUnusedBonus($client_id);
    }

}

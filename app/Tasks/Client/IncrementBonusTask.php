<?php

namespace App\Tasks\Client;

use App\Repositories\ClientRepositoryInterface;

class IncrementBonusTask{

    private ClientRepositoryInterface $client_repository;

    public function __construct(ClientRepositoryInterface $client_repository)
    {
        $this->client_repository = $client_repository;
    }

    public function run($client_id, $bonus_amount){
        return $this->client_repository->incrementBonus($client_id, $bonus_amount);
    }
}

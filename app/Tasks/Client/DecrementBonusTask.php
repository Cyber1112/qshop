<?php

namespace App\Tasks\Client;

use App\Repositories\ClientRepositoryInterface;

class DecrementBonusTask{

    private ClientRepositoryInterface $client_repository;

    public function __construct(ClientRepositoryInterface $client_repository)
    {
        $this->client_repository = $client_repository;
    }

    public function run($client_id, $bonus_amount){
        return $this->client_repository->decrementBonus($client_id, $bonus_amount);
    }
}

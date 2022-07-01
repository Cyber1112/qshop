<?php

namespace App\Tasks\Client;

use App\Repositories\ClientRepositoryInterface;

class FindTask{

    private ClientRepositoryInterface $client_repository;

    public function __construct(ClientRepositoryInterface $client_repository){
        $this->client_repository = $client_repository;
    }

    public function run($id){
        return $this->client_repository->findByUserId($id);
    }
}

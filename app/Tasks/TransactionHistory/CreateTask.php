<?php

namespace App\Tasks\TransactionHistory;

use App\Repositories\TransactionHistoryRepositoryInterface;

class CreateTask{

    private TransactionHistoryRepositoryInterface $history_repository;

    public function __construct(TransactionHistoryRepositoryInterface $history_repository){
        $this->history_repository = $history_repository;
    }

    public function run(array $payload){
        $this->history_repository->create($payload);
    }

}

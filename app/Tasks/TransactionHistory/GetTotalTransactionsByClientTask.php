<?php

namespace App\Tasks\TransactionHistory;

use App\Repositories\TransactionHistoryRepositoryInterface;

class GetTotalTransactionsByClientTask{

    private TransactionHistoryRepositoryInterface $history_repository;

    public function __construct(TransactionHistoryRepositoryInterface $history_repository){
        $this->history_repository = $history_repository;
    }

    public function run($client_id){
        return $this->history_repository->getTotalTransactionsByClient($client_id);
    }

}

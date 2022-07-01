<?php

namespace App\Tasks\TransactionHistory;

use App\Repositories\TransactionHistoryRepositoryInterface;

class DeleteTask{

    private TransactionHistoryRepositoryInterface $history_repository;

    public function __construct(TransactionHistoryRepositoryInterface $history_repository){
        $this->history_repository = $history_repository;
    }

    public function run(int $transaction_id){
        $this->history_repository->deleteTransaction($transaction_id);
    }

}

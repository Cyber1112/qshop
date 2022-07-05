<?php

namespace App\Tasks\TransactionHistory;

use App\Repositories\TransactionHistoryRepositoryInterface;

class GetBusinessTransactions{

    private TransactionHistoryRepositoryInterface $history_repository;

    public function __construct(TransactionHistoryRepositoryInterface $history_repository){
        $this->history_repository = $history_repository;
    }

    public function run($business_id){
        return $this->history_repository->getTransactionsByBusinessId($business_id, ['purchase_amount', 'created_at']);
    }
}

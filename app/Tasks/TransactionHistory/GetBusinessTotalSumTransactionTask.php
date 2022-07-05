<?php

namespace App\Tasks\TransactionHistory;

use App\Repositories\TransactionHistoryRepositoryInterface;

class GetBusinessTotalSumTransactionTask{

    private TransactionHistoryRepositoryInterface $history_repository;

    public function __construct(TransactionHistoryRepositoryInterface $history_repository){
        $this->history_repository = $history_repository;
    }

    public function run($business_id, $from, $to){
        return $this->history_repository->getBusinessTotalSumTransactions($business_id, $from, $to);
    }

}

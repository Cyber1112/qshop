<?php

namespace App\Tasks\TransactionHistory;

use App\Repositories\TransactionHistoryRepositoryInterface;

class GetClientTransactionsTask{

    private TransactionHistoryRepositoryInterface $history_repository;

    public function __construct(TransactionHistoryRepositoryInterface $history_repository){
        $this->history_repository = $history_repository;
    }

    public function run(int $business_id, string $from, string $to, array $columns=['*']){
        return $this->history_repository->getClientTransactions(
            $business_id,
            $from,
            $to,
            $columns
        );
    }

}

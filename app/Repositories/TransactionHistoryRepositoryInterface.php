<?php

namespace App\Repositories;

interface TransactionHistoryRepositoryInterface extends EloquentRepositoryInterface{


    /**
     * @param int $transaction_id
     * @return bool|null
     */
    public function deleteTransaction(int $transaction_id): ?bool;

}

<?php

namespace App\Repositories\Eloquent;

use App\Models\TransactionHistory;
use App\Repositories\TransactionHistoryRepositoryInterface;

class TransactionHistoryRepository extends BaseRepository implements TransactionHistoryRepositoryInterface{

    public function __construct(TransactionHistory $model){
        $this->model = $model;
    }

    /**
     * @param int $transaction_id
     * @return bool|null
     */
    public function deleteTransaction(int $transaction_id): ?bool
    {
        return $this->model
            ->query()
            ->where("id", $transaction_id)
            ->delete();
    }
}

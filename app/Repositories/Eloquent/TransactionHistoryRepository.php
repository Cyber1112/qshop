<?php

namespace App\Repositories\Eloquent;

use App\Models\TransactionHistory;
use App\Repositories\TransactionHistoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

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

    public function getBusinessTotalSumTransactions(int $business_id, $from, $to): int
    {
        return $this->model
                ->query()
                ->where('business_id', $business_id)
                ->whereBetween('created_at', [$from, $to])
                ->sum('purchase_amount');
    }

    public function getBusinessCountTransactions(int $business_id, $from, $to): int
    {
        return $this->model
            ->query()
            ->where('business_id', $business_id)
            ->whereBetween('created_at', [$from, $to])
            ->count('purchase_amount');
    }

    public function getAccruedBonus(int $business_id, $from, $to, $columns = ['*']): Collection
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('business_id',$business_id)
            ->whereBetween('created_at', [$from, $to])
            ->get();
    }

    public function getTransactionsByBusinessId($business_id, array $columns = ['*'], array $relations = [], array $relations_count = []): Collection
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('business_id', $business_id)
            ->get();
    }

    public function getTotalTransactionsByClient(int $client_id): int
    {
        return $this->model
            ->query()
            ->where('client_id', $client_id)
            ->count();
    }

    public function getClientPartners(int $client_id, array $columns = ['*']): Collection
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('client_id', $client_id)
            ->get();
    }
}

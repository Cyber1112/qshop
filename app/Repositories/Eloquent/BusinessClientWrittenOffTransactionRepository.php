<?php

namespace App\Repositories\Eloquent;

use App\Models\BusinessClientWroteOffTransactions;
use App\Repositories\BusinessClientWrittenOffTransactionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BusinessClientWrittenOffTransactionRepository extends BaseRepository implements BusinessClientWrittenOffTransactionRepositoryInterface{

    public function __construct(BusinessClientWroteOffTransactions $model)
    {
        $this->model = $model;
    }

    public function getBusinessTotalWrittenOffBonus(int $business_id, $from, $to): int
    {
        return $this->model
            ->query()
            ->where('business_id', $business_id)
            ->whereBetween('created_at', [$from, $to])
            ->sum('written_off_bonus');
    }

    public function calculateClientTotalWrittenOffBonus($client_id): int
    {
        return $this->model
            ->query()
            ->where('client_id', $client_id)
            ->sum('written_off_bonus');
    }

    public function getClientWrittenOffTransactions(int $client_id, string $from, string $to, array $columns = ['*']): Collection
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('client_id', $client_id)
            ->whereBetween('business_client_wrote_off_transactions.created_at', [$from, $to])
            ->join('businesses', 'businesses.id', '=', 'business_id')
            ->get();
    }
}

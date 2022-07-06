<?php

namespace App\Repositories\Eloquent;

use App\Models\BusinessClientWroteOffTransactions;
use App\Repositories\BusinessClientWrittenOffTransactionRepositoryInterface;

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

    public function getClientTotalWrittenOffBonus($client_id): int
    {
        return $this->model
            ->query()
            ->where('client_id', $client_id)
            ->sum('written_off_bonus');
    }
}

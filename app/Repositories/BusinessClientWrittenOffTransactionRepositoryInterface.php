<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface BusinessClientWrittenOffTransactionRepositoryInterface extends EloquentRepositoryInterface{

    /**
     * @param int $business_id
     * @param $from
     * @param $to
     * @return int
     */
    public function getBusinessTotalWrittenOffBonus(
        int $business_id,
            $from,
            $to
    ): int;

    /**
     * @param $client_id
     * @return int
     */
    public function calculateClientTotalWrittenOffBonus($client_id): int;

    /**
     * @param int $client_id
     * @param string $from
     * @param string $to
     * @param array $columns
     * @return Collection
     */
    public function getClientWrittenOffTransactions(
        int $client_id,
        string $from,
        string $to,
        array $columns = ['*']
    ): Collection;
}

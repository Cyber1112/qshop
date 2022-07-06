<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface TransactionHistoryRepositoryInterface extends EloquentRepositoryInterface{


    /**
     * @param int $transaction_id
     * @return bool|null
     */
    public function deleteTransaction(int $transaction_id): ?bool;


    public function getTransactionsByBusinessId(
        $business_id,
        array $columns = ['*'],
        array $relations = [],
        array $relations_count = []
    ): Collection;


    public function getBusinessTotalSumTransactions(
        int $business_id,
        $from,
        $to
    ):int;

    public function getBusinessCountTransactions(
        int $business_id,
        $from,
        $to
    ): int;

    public function getAccruedBonus(
        int $business_id,
        $from,
        $to,
        $columns = ['*']
    ): Collection;

    /**
     * @param int $client_id
     * @return int
     */
    public function getTotalTransactionsByClient(
        int $client_id
    ): int;

    /**
     * @param int $client_id
     * @param array $columns
     * @return Collection
     */
    public function getClientPartners(
        int $client_id,
        array $columns = ['*']
    ): Collection;

    public function getClientTransactions(
        int $client_id,
        string $from,
        string $to,
        array $columns = ['*']
    ): Collection;

}

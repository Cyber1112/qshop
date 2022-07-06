<?php

namespace App\Tasks\BusinessClientWrittenOffTransaction;

use App\Repositories\BusinessClientWrittenOffTransactionRepositoryInterface;

class GetClientWrittenOffBonus{

    private BusinessClientWrittenOffTransactionRepositoryInterface $transaction_repository;

    public function __construct(BusinessClientWrittenOffTransactionRepositoryInterface $transaction_repository){
        $this->transaction_repository = $transaction_repository;
    }

    public function run(int $client_id, string $from, string $to, array $columns = ['*']){
        return $this->transaction_repository->getClientWrittenOffTransactions(
            $client_id,
            $from,
            $to,
            $columns
        );
    }

}

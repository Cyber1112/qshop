<?php

namespace App\Tasks\BusinessClientWrittenOffTransaction;

use App\Repositories\BusinessClientWrittenOffTransactionRepositoryInterface;

class CalculateWrittenOffBonusByClientTask{

    private BusinessClientWrittenOffTransactionRepositoryInterface $transaction_repository;

    public function __construct(BusinessClientWrittenOffTransactionRepositoryInterface $transaction_repository){
        $this->transaction_repository = $transaction_repository;
    }

    public function run($client_id){
        return $this->transaction_repository->calculateClientTotalWrittenOffBonus($client_id);
    }

}

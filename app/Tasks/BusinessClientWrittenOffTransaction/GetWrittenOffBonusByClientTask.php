<?php

namespace App\Tasks\BusinessClientWrittenOffTransaction;

use App\Repositories\BusinessClientWrittenOffTransactionRepositoryInterface;

class GetWrittenOffBonusByClientTask{

    private BusinessClientWrittenOffTransactionRepositoryInterface $transaction_repository;

    public function __construct(BusinessClientWrittenOffTransactionRepositoryInterface $transaction_repository){
        $this->transaction_repository = $transaction_repository;
    }

    public function run($client_id){
        return $this->transaction_repository->getClientTotalWrittenOffBonus($client_id);
    }

}

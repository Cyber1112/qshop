<?php

namespace App\Tasks\BusinessClientWrittenOffTransaction;

use App\Repositories\BusinessClientWrittenOffTransactionRepositoryInterface;

class GetWrittenOffBonusTask{

    private BusinessClientWrittenOffTransactionRepositoryInterface $transaction_repository;

    public function __construct(BusinessClientWrittenOffTransactionRepositoryInterface $transaction_repository){
        $this->transaction_repository = $transaction_repository;
    }

    public function run($business_id, $from, $to){
        return $this->transaction_repository->getBusinessTotalWrittenOffBonus($business_id, $from, $to);
    }

}

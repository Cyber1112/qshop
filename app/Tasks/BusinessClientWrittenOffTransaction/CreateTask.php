<?php

namespace App\Tasks\BusinessClientWrittenOffTransaction;

use App\Repositories\BusinessClientWrittenOffTransactionRepositoryInterface;

class CreateTask{

    private BusinessClientWrittenOffTransactionRepositoryInterface $transaction_repository;

    public function __construct(BusinessClientWrittenOffTransactionRepositoryInterface $transaction_repository){
        $this->transaction_repository = $transaction_repository;
    }

    public function run(array $payload){
        return $this->transaction_repository->create($payload);
    }

}

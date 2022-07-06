<?php

namespace App\Tasks\TransactionHistory;

use App\Repositories\TransactionHistoryRepositoryInterface;

class GetTotalClientPartnersTask{

    private TransactionHistoryRepositoryInterface $history_repository;

    public function __construct(TransactionHistoryRepositoryInterface $history_repository){
        $this->history_repository = $history_repository;
    }

    public function run($client_id){
        return $this->history_repository->getClientPartners($client_id, ['client_id', 'business_id']);
    }

}

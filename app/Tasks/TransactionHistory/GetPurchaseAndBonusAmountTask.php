<?php

namespace App\Tasks\TransactionHistory;

use App\Repositories\TransactionHistoryRepositoryInterface;

class GetPurchaseAndBonusAmountTask{

    private TransactionHistoryRepositoryInterface $history_repository;

    public function __construct(TransactionHistoryRepositoryInterface $history_repository){
        $this->history_repository = $history_repository;
    }

    public function run($business_id, $from, $to){
        return $this->history_repository->getAccruedBonus(
            $business_id,
            $from,
            $to,
            ['bonus_amount', 'purchase_amount']
        );
    }

}

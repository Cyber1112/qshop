<?php

namespace App\Actions;

use App\Contracts\DeleteTransaction;
use App\Tasks;

class DeleteAction implements DeleteTransaction{

    public function execute(int $transaction_id, int $business_id, int $client_id, int $bonus_amount, int $purchase_amount): void
    {
        $this->writeOffBonus($client_id, $bonus_amount);
        $this->topUpBalance($business_id, $purchase_amount);
        $this->deleteTransaction($transaction_id);
    }

    public function deleteTransaction($transaction_id){
        app(Tasks\TransactionHistory\DeleteTask::class)->run($transaction_id);
    }

    public function writeOffBonus($client_id, $bonus_amount){
        app(Tasks\Client\DecrementBonusTask::class)->run($client_id, $bonus_amount);
    }

    public function topUpBalance($business_id, $purchase_amount){
        app(Tasks\Business\TopUpMoneyTask::class)->run($business_id, $purchase_amount);
    }
}

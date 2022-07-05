<?php

namespace App\Actions\BusinessTransactionHistory;

use App\Contracts\DeleteTransaction;
use App\Tasks;

class DeleteAction implements DeleteTransaction{

    public function execute(int $transaction_id): void
    {
        app(Tasks\TransactionHistory\DeleteTask::class)->run($transaction_id);
    }

}

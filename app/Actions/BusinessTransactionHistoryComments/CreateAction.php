<?php

namespace App\Actions\BusinessTransactionHistoryComments;

use App\Contracts\TransactionComments;
use App\Tasks;

class CreateAction implements TransactionComments {

    public function execute($comment, $transaction_history_id): void
    {
        app(Tasks\TransactionComments\CreateTask::class)->run([
            'comment' => $comment,
            'transaction_history_id' => $transaction_history_id
        ]);
    }

}

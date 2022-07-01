<?php

namespace App\Contracts;

interface TransactionComments{

    public function execute($comment, $transaction_history_id): void;

}

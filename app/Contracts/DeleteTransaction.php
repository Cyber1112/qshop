<?php

namespace App\Contracts;

interface DeleteTransaction{

    public function execute(int $transaction_id, int $business_id, int $client_id, int $bonus_amount, int $purchase_amount): void;

}

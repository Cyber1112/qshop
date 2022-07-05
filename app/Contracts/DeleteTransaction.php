<?php

namespace App\Contracts;

interface DeleteTransaction{

    public function execute(int $transaction_id): void;

}

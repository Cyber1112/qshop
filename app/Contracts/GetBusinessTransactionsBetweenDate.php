<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface GetBusinessTransactionsBetweenDate{

    public function execute(string $from, string $to): Collection;

}

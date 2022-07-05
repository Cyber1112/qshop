<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface GetBusinessTransactionsBetweenDate{

    public function execute($business_id, $from, $to): Collection;

}

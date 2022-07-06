<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface GetAccruedAndWrittenOffTransactions{

    /**
     * @return Collection
     */
    public function execute(string $from, string $to): Collection;

}

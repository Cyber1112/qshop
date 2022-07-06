<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface GetStatistics{

    public function execute(string $period): Collection;

}

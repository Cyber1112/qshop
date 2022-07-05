<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface GetStatistics{

    public function execute($business_id, $period): Collection;

}

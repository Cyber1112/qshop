<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface GetClientBusinessCategory{

    public function execute(int $category_id): Collection;

}

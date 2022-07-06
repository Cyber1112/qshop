<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface GetBusinessClientBonus{

    public function execute($client_id): Collection;

}

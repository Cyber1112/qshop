<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface WriteOffBonusFromClient{

    public function execute(Collection $data, int $bonus_amount): void;

}

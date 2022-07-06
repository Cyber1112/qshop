<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface GetClientFullInfo{

    public function execute(): Collection;

}

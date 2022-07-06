<?php

namespace App\Contracts;


use Illuminate\Support\Collection;

interface GetClientActivationBonusDate{

    public function execute(): Collection;

}

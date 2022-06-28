<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface GetAllCities
{
    /**
     * @return Collection
     */
    public function execute(): Collection;
}

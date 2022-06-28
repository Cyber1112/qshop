<?php

namespace App\Actions\City;

use App\Contracts\GetAllCities;
use Illuminate\Database\Eloquent\Collection;
use App\Tasks as Tasks;

class GetAllAction implements GetAllCities
{
    /**
     * @return Collection
     */
    public function execute(): Collection
    {
        return app(Tasks\City\GetAllTask::class)->run(
            ['id', 'city']
        );
    }
}

<?php

namespace App\Actions\BusinessClientBonus;


use App\Contracts\GetBusinessClientBonus;
use Illuminate\Database\Eloquent\Collection;
use App\Tasks;


class GetBusinessClientAction implements GetBusinessClientBonus {

    public function execute($client_id, $business_id): Collection
    {
        return app(Tasks\BusinessClientBonus\FindTask::class)->run($client_id, $business_id);
    }
}

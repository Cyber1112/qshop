<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

interface BusinessClientBonusRepositoryInterface extends EloquentRepositoryInterface{

    public function getClientUnusedBonus(
        int $client_id,
        int $business_id,
        array $columns = ['*'],
        array $relations = [],
        array $relations_count = []
    ): Collection;

    public function updateClientUnusedBonus(
        int $business_client_bonus_id,
        int $balance,
        string $status,
        array $columns = ['*'],
        array $relations = [],
        array $relations_count = []
    ): int;

}

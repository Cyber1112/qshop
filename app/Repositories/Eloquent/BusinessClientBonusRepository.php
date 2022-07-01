<?php

namespace App\Repositories\Eloquent;

use App\Models\BusinessClientBonus;
use App\Repositories\BusinessClientBonusRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class BusinessClientBonusRepository extends BaseRepository implements BusinessClientBonusRepositoryInterface{


    public function __construct(BusinessClientBonus $model){
        $this->model = $model;
    }

    public function getClientUnusedBonus(
        int $client_id,
        int $business_id,
        array $columns = ['*'],
        array $relations = [],
        array $relations_count = []
    ): Collection
    {
        return $this->model
                ->query()
                ->select($columns)
                ->where('client_id', $client_id)
                ->where('business_id', $business_id)
                ->where('status', 'not_used')
                ->where('activation_bonus_date', '<', now()->toDateTimeString())
                ->orderByRaw('ISNULL(deactivation_bonus_date), deactivation_bonus_date ASC')
                ->with($relations)
                ->withCount($relations_count)
                ->get();

    }

    public function updateClientUnusedBonus(
        int $business_client_bonus_id,
        int $balance,
        string $status,
        array $columns = ['*'],
        array $relations = [],
        array $relations_count = []
    ): int
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('id', $business_client_bonus_id)
            ->update([
                'balance' => $balance,
                'status' => $status
            ]);
    }
}

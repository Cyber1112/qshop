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

    /**
     * @param int $client_id
     * @param int $business_id
     * @param array $columns
     * @param array $relations
     * @param array $relations_count
     * @return Collection
     */
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
                ->where('activation_bonus_date', '<', now()->toDateTimeString())
                ->orderByRaw('ISNULL(deactivation_bonus_date), deactivation_bonus_date ASC')
                ->with($relations)
                ->withCount($relations_count)
                ->get();

    }

    /**
     * @param int $business_client_bonus_id
     * @param int $balance
     * @param string $status
     * @param array $columns
     * @param array $relations
     * @param array $relations_count
     * @return int
     */
    public function updateClientUnusedBonus(
        int $business_client_bonus_id,
        int $balance,
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
                'balance' => $balance
            ]);
    }

    /**
     * @param int $client_id
     * @param array $columns
     * @param array $relations
     * @param array $relations_count
     * @return Collection
     */
    public function getClientPartners(int $client_id, array $columns = ['*'], array $relations = [], array $relations_count = []): Collection
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('client_id', $client_id)
            ->join('businesses', 'businesses.id', '=', 'business_id')
            ->get();
    }

    /**
     * @param int $client_id
     * @return int
     */
    public function getTotalUnusedBonus(int $client_id): int
    {
        return $this->model
            ->query()
            ->where('client_id', $client_id)
            ->where('activation_bonus_date', '<', now()->toDateTimeString())
            ->sum('balance');
    }

    public function getClientUnActivatedBonus(int $client_id): int
    {
        return $this->model
            ->query()
            ->where('client_id', $client_id)
            ->where('activation_bonus_date', '>', now()->toDateTimeString())
            ->count();
    }

    public function deleteClientBonus(int $id): ?bool
    {
        return $this->model
            ->query()
            ->where('id', $id)
            ->delete();
    }

    public function getClientActivatedBonus(int $client_id, array $columns = ['*']): Collection
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('client_id', $client_id)
            ->where('activation_bonus_date', '<', now()->toDateTimeString())
            ->get();
    }
}

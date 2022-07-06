<?php

namespace App\Repositories\Eloquent;

use App\Models\Business;
use App\Repositories\BusinessRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BusinessRepository extends BaseRepository implements BusinessRepositoryInterface{

    public function __construct(Business $model){
        $this->model = $model;
    }

    /**
     * @param int $user_id
     * @param array $columns
     * @param array $relations
     * @param array $relations_count
     * @return Business|null
     */
    public function findByUserId(
        int $user_id,
        array $columns = ['*'],
        array $relations = [],
        array $relations_count = []
    ): ?Business
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('user_id', $user_id)
            ->with($relations)
            ->withCount($relations_count)
            ->first();
    }


    /**
     * @param int $business_id
     * @param int $purchase_amount
     * @return int|null
     */
    public function decrementBalance(int $business_id, int $purchase_amount): ?int
    {
        return $this->model
                ->query()
                ->where('id', $business_id)
                ->decrement('balance', $purchase_amount);
    }

    /**
     * @param int $business_id
     * @param int $purchase_amount
     * @return int|null
     */
    public function incrementBalance(int $business_id, int $purchase_amount): ?int
    {
        return $this->model
            ->query()
            ->where('id', $business_id)
            ->increment('balance', $purchase_amount);
    }

    public function getBusinessBonusOptions(array $columns = ['*']): Collection
    {
        return $this->model
            ->query()
            ->select($columns)
            ->join('business_bonus_options', 'business_bonus_options.business_id', '=', 'businesses.id')
            ->get();

    }
}

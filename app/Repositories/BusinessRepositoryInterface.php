<?php

namespace App\Repositories;


use App\Models\Business;
use Illuminate\Database\Eloquent\Collection;

interface BusinessRepositoryInterface extends EloquentRepositoryInterface{

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
    ): ?Business;

    /**
     * @param int $business_id
     * @param int $purchase_amount
     * @return int|null
     */
    public function decrementBalance
    (
        int $business_id,
        int $purchase_amount
    ): ?int;

    /**
     * @param int $business_id
     * @param int $purchase_amount
     * @return int|null
     */
    public function incrementBalance
    (
        int $business_id,
        int $purchase_amount
    ): ?int;

}

<?php

namespace App\Repositories;

use App\Models\BusinessBonusOption;

interface BusinessBonusRepositoryInterface extends EloquentRepositoryInterface {

    /**
     * @param int $business_id
     * @param array $columns
     * @param array $relations
     * @param array $relations_count
     * @return BusinessBonusOption|null
     */
    public function findByBusinessId(
        int $business_id,
        array $columns = ['*'],
        array $relations = [],
        array $relations_count = []
    ): ?BusinessBonusOption;

}

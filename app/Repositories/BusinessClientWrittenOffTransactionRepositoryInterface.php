<?php

namespace App\Repositories;

interface BusinessClientWrittenOffTransactionRepositoryInterface extends EloquentRepositoryInterface{

    /**
     * @param int $business_id
     * @param $from
     * @param $to
     * @return int
     */
    public function getBusinessTotalWrittenOffBonus(
        int $business_id,
            $from,
            $to
    ): int;

}

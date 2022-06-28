<?php

namespace App\Tasks\BusinessAccount;

use App\Models\Business;

class UpdateBusinessNameTask{

    /**
     * @param Business $business
     * @param array $payload
     * @return bool
     */
    public function run(Business $business, array $payload): bool
    {
        return $business->update($payload);
    }

}

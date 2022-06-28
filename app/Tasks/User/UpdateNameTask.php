<?php

namespace App\Tasks\User;

use App\Models\User;

class UpdateNameTask{

    /**
     * @param User $user
     * @param array $payload
     * @return bool
     */
    public function run(User $user, array $payload): bool
    {
        return $user->update($payload);
    }

}

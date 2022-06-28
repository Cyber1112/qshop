<?php

namespace App\Tasks\User;

use App\Models\User;

class AssignRoleTask{

    /**
     * @param User $user
     * @param $roles
     * @return void
     */
    public function run(User $user, $roles){
        $user->assignRole($roles);
    }
}

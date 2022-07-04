<?php

namespace App\Helpers;

use App\Tasks;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class DefineUserRole{

    public function defineRole($user, $permission){
        if ( $user->hasRole('employee') ){
            if ( $user->hasPermissionTo($permission) ){
                return $this->getBusinessIdByEmployee($user);
            }
            throw new AccessDeniedException("You are not given permission", 401);
        }
        if ($user->hasRole('business')){
            return $this->getBusinessIdByBusiness($user);
        }

    }

    public function getBusinessIdByEmployee($user){
        return app(Tasks\Employee\FindTask::class)->run(
            $user->id
        )->business_id;
    }

    public function getBusinessIdByBusiness($user){
        return app(Tasks\Business\FindTask::class)->run(
            $user->id
        )->id;
    }


}

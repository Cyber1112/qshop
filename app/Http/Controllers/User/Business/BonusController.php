<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessBonus\CreateRequest;
use Illuminate\Http\Request;
use App\Contracts;
use Illuminate\Support\Facades\Auth;
use App\Tasks;
use App\Dto;

class BonusController extends Controller
{
    public function createBonus(CreateRequest $request){
        $user = Auth::user();

        if ( $user->hasRole('employee') ){
            if ( $user->hasPermissionTo('manipulate bonus') ){
                return $this->setBonus(
                    $this->getBusinessIdByEmployee($user),
                    Dto\BusinessBonus\CreateDtoFactory::fromRequest($request)
                );
            }
            return response()->json(["You are not given permission to manipulate bonus"], 401);
        }


        return $this->setBonus(
            $this->getBusinessIdByBusiness($user),
            Dto\BusinessBonus\CreateDtoFactory::fromRequest($request)
        );

    }

    public function setBonus($business_id, $dto){

        app(Contracts\BusinessBonus::class)->execute(
            $business_id,
            $dto
        );

        return response()->noContent();
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

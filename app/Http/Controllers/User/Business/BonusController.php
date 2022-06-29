<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts;
use Illuminate\Support\Facades\Auth;
use App\Tasks;

class BonusController extends Controller
{
    public function createBonus(Request $request){
        $user = Auth::user();

        if ( $user->hasRole('employee') ){
            if ( $user->hasPermissionTo('manipulate bonus') ){
                return $this->setBonus(
                    $this->getBusinessIdByEmployee($user),
                    $request->bonus_amount,
                    $request->activation_bonus_period,
                    $request->deactivation_bonus_period
                );
            }
            return response()->json(["You are not given permission to manipulate bonus"], 401);
        }

        return $this->setBonus(
            $this->getBusinessIdByBusiness($user),
            $request->bonus_amount,
            $request->activation_bonus_period ?? 0,
            $request->deactivation_bonus_period ?? null
        );

    }

    public function setBonus($business_id, $bonus_amount, $activation_bonus_period = 0, $deactivation_bonus_period = null){

        app(Contracts\BusinessBonus::class)->execute(
            $business_id,
            $bonus_amount,
            $activation_bonus_period,
            $deactivation_bonus_period
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

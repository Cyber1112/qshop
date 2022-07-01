<?php

namespace App\Http\Controllers\User\Business;

use App\Contracts\GetBusinessClientBonus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts;
use App\Tasks;
use Illuminate\Support\Facades\Auth;

class BusinessClientBonusController extends Controller
{
    public function __construct()
    {
//        $this->data = app(Contracts\BusinessClientBonus::class)->execute(1, 1);
    }

    public function get(Request $request){
        return app(Contracts\GetBusinessClientBonus::class)->execute(1, 1);
    }

    public function writeOffTransaction(Request $request){

        $user = Auth::user();
        $bonus_amount = $request->bonus_amount;
        $clientExist = $this->checkNumber($request->phone_number);
        if (!$clientExist){
            return response()->json(['message' => "The user with number $request->phone_number is not found" ], 404);
        }
        $client_id = $this->getClientId($clientExist);

        if ($user->hasRole('employee')){
            if ($user->hasPermissionTo('manipulate bonus')){
                $business_id = $this->getBusinessIdByEmployee($user);
                $data = $this->getBusinessClientBonusCollection($client_id, $business_id);
                return $this->writeOffBonus($data, $bonus_amount);
            }
            return response()->json(['message' => "You are not given permission to manipulate bonus"], 401);
        }

        $business_id = $this->getBusinessIdByBusiness($user);
        $data = $this->getBusinessClientBonusCollection($client_id, $business_id);
        return $this->writeOffBonus($data, $bonus_amount);

    }


    public function getBusinessClientBonusCollection($client_id, $business_id){
        return app(Contracts\GetBusinessClientBonus::class)->execute($client_id, $business_id);
    }

    public function writeOffBonus($data, $bonus_amount){
        app(Contracts\WriteOffBonusFromClient::class)->execute($data, $bonus_amount);
        return response()->noContent();
    }


    public function getClientId($client_id){
        return app(Tasks\Client\FindTask::class)->run($client_id)->id;
    }


    public function checkNumber($phone_number){
        return app(Tasks\User\FindByPhoneTask::class)->run($phone_number)->id;
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

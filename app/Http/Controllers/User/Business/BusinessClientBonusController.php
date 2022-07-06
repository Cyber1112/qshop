<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts;
use App\Tasks;

class BusinessClientBonusController extends Controller
{

    public function get(Request $request){
        return app(Contracts\GetBusinessClientBonus::class)->execute(1, 1);
    }

    public function writeOffTransaction(Request $request){

        $clientExist = app(Tasks\User\FindByPhoneTask::class)->run($request->phone_number)->id;

        if (!$clientExist){
            return response()->json(['message' => "The user with number $request->phone_number is not found" ], 404);
        }

        $client_id = app(Tasks\Client\FindTask::class)->run($clientExist)->id;


        $data = app(Contracts\GetBusinessClientBonus::class)->execute($client_id);

        app(Contracts\WriteOffBonusFromClient::class)->execute(
            $data, $request->bonus_amount
        );
        return response()->noContent();
    }


}

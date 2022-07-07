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

        app(Contracts\WriteOffBonusFromClient::class)->execute(
            $request->phone_number, $request->bonus_amount
        );
        return response()->noContent();
    }


}

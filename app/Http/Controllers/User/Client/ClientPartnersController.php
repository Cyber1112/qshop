<?php

namespace App\Http\Controllers\User\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts;

class ClientPartnersController extends Controller
{

    public function showPartners(Request $request){
        return app(Contracts\GetClientPartners::class)->execute();
    }

    public function getFullInfo(Request $request){
        return app(Contracts\GetClientFullInfo::class)->execute();
    }

    public function getActivationBonusDate(Request $request){
        return app(Contracts\GetClientActivationBonusDate::class)->execute();
    }
}

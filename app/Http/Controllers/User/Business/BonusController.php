<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessBonus\CreateRequest;
use App\Contracts;
use App\Tasks;
use App\Dto;

class BonusController extends Controller
{

    public function createBonus(CreateRequest $request){
        app(Contracts\BusinessBonus::class)->execute(
            Dto\BusinessBonus\CreateDtoFactory::fromRequest($request)
        );

       return response()->noContent();

    }

}

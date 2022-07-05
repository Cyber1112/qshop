<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessBonus\CreateRequest;
use Illuminate\Http\Request;
use App\Contracts;
use Illuminate\Support\Facades\Auth;
use App\Tasks;
use App\Dto;
use App\Helpers;

class BonusController extends Controller
{

    public function createBonus(CreateRequest $request){
        $user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());

        app(Contracts\BusinessBonus::class)->execute(
            $user,
            Dto\BusinessBonus\CreateDtoFactory::fromRequest($request)
        );

       return response()->noContent();

    }

}

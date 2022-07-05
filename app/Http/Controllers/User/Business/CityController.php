<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Tasks;
use App\Helpers;

class CityController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function addCity(Request $request): \Illuminate\Http\JsonResponse|Response
    {
        $user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());

        app(Contracts\BusinessCity::class)->execute(
            $request->city_id,
            $user
        );

        return response()->noContent();
    }

}

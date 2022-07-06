<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts;
use Illuminate\Http\Response;
use App\Tasks;

class CityController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function addCity(Request $request): \Illuminate\Http\JsonResponse|Response
    {

        app(Contracts\BusinessCity::class)->execute(
            $request->city_id,
        );

        return response()->noContent();
    }

}

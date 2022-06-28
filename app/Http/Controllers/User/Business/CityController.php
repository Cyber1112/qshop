<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts;
use Illuminate\Http\Response;

class CityController extends Controller
{

    public function addCity(Request $request): Response
    {

        app(Contracts\BusinessCity::class)->execute(
            $request->city_id
        );

        return response()->noContent();
    }

}

<?php

namespace App\Http\Controllers\City;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts;
use App\Http\Resources;

class CityController extends Controller
{
    public function index()
    {
        $cities = app(Contracts\GetAllCities::class)->execute();
        return new Resources\City\Collection($cities);
    }
}

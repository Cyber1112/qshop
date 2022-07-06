<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts;

class StatisticsController extends Controller
{
    public function index(Request $request){
        return app(Contracts\GetStatistics::class)->execute('week');
    }
}

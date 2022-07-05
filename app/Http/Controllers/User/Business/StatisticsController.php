<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts;
use Illuminate\Support\Facades\Auth;
use App\Helpers;

class StatisticsController extends Controller
{
    public function index(Request $request){
        $user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());

        return app(Contracts\GetStatistics::class)->execute($user, 'week');
    }
}

<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Tasks;

class CityController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function addCity(Request $request): \Illuminate\Http\JsonResponse|Response
    {
        $user = Auth::user();

        if ( $user->hasRole('employee') ){
            if ( $user->hasPermissionTo('edit profile') ){
                return $this->setCity($request->city_id, $this->getBusinessIdByEmployee($user));
            }
            return response()->json(['You are not given permission to edit edit profile'], 401);
        }

        return $this->setCity($request->city_id, $this->getBusinessIdByBusiness($user));
    }

    public function setCity($city_id, $user){
        app(Contracts\BusinessCity::class)->execute(
            $city_id,
            $user
        );
        return response()->noContent();
    }

    public function getBusinessIdByEmployee($user){
        return app(Tasks\Employee\FindTask::class)->run(
            $user->id
        )->business_id;
    }

    public function getBusinessIdByBusiness($user){
        return app(Tasks\Business\FindTask::class)->run(
            $user->id
        )->id;
    }

}

<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessSchedule\CreateRequest;
use App\Contracts;
use App\Dto;
use Illuminate\Http\Response;
use App\Tasks;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * @param CreateRequest $request
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function addSchedule(CreateRequest $request): Response|\Illuminate\Http\JsonResponse
    {
        $user = Auth::user();

        if ( $user->hasRole('employee') ){
            if ( $user->hasPermissionTo('edit profile') ){
                return $this->setSchedule(
                    $request,
                    $this->getBusinessIdByEmployee($user)
                );
            }
            return response()->json(['You are not given permission to edit profile'], 401);
        }

        return $this->setSchedule(
            $request,
            $this->getBusinessIdByBusiness($user)
        );

    }

    public function setSchedule($categories, $user){
            app(Contracts\BusinessSchedule::class)->execute(
                $categories,
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

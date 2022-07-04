<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessSchedule\CreateRequest;
use App\Contracts;
use App\Dto;
use Illuminate\Http\Response;
use App\Tasks;
use Illuminate\Support\Facades\Auth;
use App\Helpers;

class ScheduleController extends Controller
{
    /**
     * @param CreateRequest $request
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function addSchedule(CreateRequest $request): Response|\Illuminate\Http\JsonResponse
    {
        $user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user(), 'edit profile');

        app(Contracts\BusinessSchedule::class)->execute(
            $request,
            $user
        );
        return response()->noContent();

    }

}

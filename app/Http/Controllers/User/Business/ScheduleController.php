<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessSchedule\CreateRequest;
use App\Contracts;
use App\Dto;
use Illuminate\Http\Response;
use App\Tasks;

class ScheduleController extends Controller
{
    /**
     * @param CreateRequest $request
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function addSchedule(CreateRequest $request): Response|\Illuminate\Http\JsonResponse
    {
        app(Contracts\BusinessSchedule::class)->execute($request);
        return response()->noContent();

    }

}

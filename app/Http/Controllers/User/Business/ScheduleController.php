<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessSchedule\CreateRequest;
use App\Contracts;
use App\Dto;
use Illuminate\Http\Response;

class ScheduleController extends Controller
{
    /**
     * @param CreateRequest $request
     * @return Response
     */
    public function addSchedule(CreateRequest $request): Response
    {
        app(Contracts\BusinessSchedule::class)->execute(
            $request
        );

        return response()->noContent();
    }



}

<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessDescription\CreateRequest;
use App\Contracts;
use App\Dto;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Tasks;
use App\Helpers;

class DescriptionController extends Controller
{

    /**
     * @param CreateRequest $request
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function createDescrption(CreateRequest $request): \Illuminate\Http\JsonResponse|Response
    {
        $user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());

        app(Contracts\BusinessDescription::class)->execute(
            Dto\BusinessDescription\CreateDtoFactory::fromRequest($request),
            $user
        );

        return response()->noContent();
    }

}

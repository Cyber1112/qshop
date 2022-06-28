<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessDescription\CreateRequest;
use App\Contracts;
use App\Dto;
use Illuminate\Http\Response;

class DescriptionController extends Controller
{

    /**
     * @param CreateRequest $request
     * @return Response
     */
    public function createDescrption(CreateRequest $request): Response
    {
        app(Contracts\BusinessDescription::class)->execute(
            Dto\BusinessDescription\CreateDtoFactory::fromRequest($request)
        );

        return response()->noContent();
    }

}

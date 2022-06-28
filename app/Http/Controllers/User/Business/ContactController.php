<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessContacts\CreateRequest;
use App\Contracts;
use App\Dto;
use Illuminate\Http\Response;


class ContactController extends Controller
{

    /**
     * @param CreateRequest $request
     * @return Response
     */
    public function createContact(CreateRequest $request): Response
    {
        app(Contracts\ContactInformation::class)->execute(
            Dto\BusinessContact\CreateDtoFactory::fromRequest($request)
        );
        return response()->noContent();;

    }

}

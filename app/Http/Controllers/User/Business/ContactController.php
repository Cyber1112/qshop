<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessContacts\CreateRequest;
use App\Contracts;
use App\Dto;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Tasks;
use App\Helpers;

class ContactController extends Controller
{

    /**
     * @param CreateRequest $request
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function createContact(CreateRequest $request): \Illuminate\Http\JsonResponse|Response
    {

        $user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user(), 'edit profile');

        app(Contracts\ContactInformation::class)->execute(
            Dto\BusinessContact\CreateDtoFactory::fromRequest($request),
            $user
        );
        return response()->noContent();

    }

}

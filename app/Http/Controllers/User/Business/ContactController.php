<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessContacts\CreateRequest;
use App\Contracts;
use App\Dto;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Tasks;

class ContactController extends Controller
{

    /**
     * @param CreateRequest $request
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function createContact(CreateRequest $request): \Illuminate\Http\JsonResponse|Response
    {

        $user = Auth::user();

        if($user->hasRole('employee')){

            if ( $user->hasPermissionTo('edit profile') ){
                return $this->setContact(
                    Dto\BusinessContact\CreateDtoFactory::fromRequest($request),
                    $this->getBusinessIdByEmployee($user)
                );
            }
            return response()->json(
                ["You are not given permission to edit edit profile"], 401);
        }

        $this->setContact(
            Dto\BusinessContact\CreateDtoFactory::fromRequest($request),
            $this->getBusinessIdByBusiness($user)
        );

        return response()->noContent();

    }

    public function setContact($dto, $user){
        app(Contracts\ContactInformation::class)->execute(
            $dto,
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

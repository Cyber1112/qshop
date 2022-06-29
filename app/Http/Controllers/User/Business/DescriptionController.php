<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessDescription\CreateRequest;
use App\Contracts;
use App\Dto;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Tasks;

class DescriptionController extends Controller
{

    /**
     * @param CreateRequest $request
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function createDescrption(CreateRequest $request): \Illuminate\Http\JsonResponse|Response
    {
        $user = Auth::user();

        if($user->hasRole('employee')){

            if ( $user->hasPermissionTo('edit profile') ){
                return $this->setDescription(
                    Dto\BusinessDescription\CreateDtoFactory::fromRequest($request),
                    $this->getBusinessIdByEmployee($user)
                );
            }

            return response()->json(
                ["You are not given permission to edit edit profile"], 401);
        }

        return $this->setDescription(
            Dto\BusinessDescription\CreateDtoFactory::fromRequest($request),
            $this->getBusinessIdByBusiness($user)
        );

    }

    public function setDescription($dto, $user){
        app(Contracts\BusinessDescription::class)->execute(
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

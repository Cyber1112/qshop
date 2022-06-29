<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Tasks;

class CategoryController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function addCategory(Request $request): \Illuminate\Http\JsonResponse|Response
    {
        $user = Auth::user();

        if ( $user->hasRole('employee') ){
            if ( $user->hasPermissionTo('edit profile') ){
                return $this->setCategory($this->getBusinessIdByEmployee($user), $request->categories);
            }
            return response()->json(['You are not given permission to edit edit profile'], 401);
        }

        return $this->setCategory($this->getBusinessIdByBusiness($user), $request->categories);
    }


    public function setCategory($user, $categories){
        app(Contracts\BusinessCategory::class)->execute(
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

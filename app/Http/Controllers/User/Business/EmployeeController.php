<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessEmployee\CreateRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Contracts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Tasks;
use App\Http\Resources;
use App\Dto;

class EmployeeController extends Controller
{

    public function index(Request $request){
        $employee = app(Tasks\Employee\FindTask::class)->run(Auth::user()->id);
        return Resources\User\Employee\Account\ProfileResource::collection(Employee::find($employee));
    }

    public function create(CreateRequest $request){
        $user = Auth::user();

        if ( $user->hasRole('employee') ){

            if ( $user->hasPermissionTo('create employee') ){
                $this->setEmployee(
                    Dto\BusinessEmployee\CreateDtoFactory::fromRequest($request),
                    $this->getBusinessIdByEmployee($user)
                );

                return response()->noContent();
            }
            return response()->json(["You are not given permission to add employee"], 401);
        }

//        BUSINESS
        return $this->setEmployee(
            Dto\BusinessEmployee\CreateDtoFactory::fromRequest($request),
            $this->getBusinessIdByBusiness($user)
        );

//        return response()->noContent();
    }

    public function setEmployee($dto, $user){
        return app(Contracts\AddEmployee::class)->execute(
            $dto,
            $user
        );
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

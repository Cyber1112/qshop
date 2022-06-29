<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Contracts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Tasks;
use App\Http\Resources;

class EmployeeController extends Controller
{

    public function index(Request $request){
        $employee = app(Tasks\Employee\FindTask::class)->run(Auth::user()->id);
        return Resources\User\Employee\Account\ProfileResource::collection(Employee::find($employee));
    }

    public function create(Request $request){
        $user = Auth::user();

        if ( $user->hasRole('employee') ){

            if ( $user->hasPermissionTo('create employee') ){
                $this->setEmployee(
                    $request->phone_number,
                    $request->name,
                    $request->position,
                    Hash::make($request->password),
                    $request->permissions,
                    $this->getBusinessIdByEmployee($user)
                );

                return response()->noContent();
            }
            return response()->json(["You are not given permission to add employee"], 401);
        }

        $this->setEmployee(
            $request->phone_number,
            $request->name,
            $request->position,
            Hash::make($request->password),
            $request->permissions,
            $this->getBusinessIdByBusiness($user)
        );

        return response()->noContent();
    }

    public function setEmployee($phone_number, $name, $position, $password, $permissions, $user){
        app(Contracts\AddEmployee::class)->execute(
            $phone_number,
            $name,
            $position,
            $password,
            $permissions,
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

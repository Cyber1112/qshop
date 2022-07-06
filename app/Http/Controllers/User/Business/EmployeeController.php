<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessEmployee\CreateRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Contracts;
use Illuminate\Support\Facades\Auth;
use App\Tasks;
use App\Http\Resources;
use App\Dto;
use App\Helpers;

class EmployeeController extends Controller
{

    public function index(Request $request){
        $employee = app(Tasks\Employee\FindTask::class)->run(Auth::user()->id);
        return Resources\User\Employee\Account\ProfileResource::collection(Employee::find($employee));
    }

    public function create(CreateRequest $request){

        app(Contracts\AddEmployee::class)->execute(
            Dto\BusinessEmployee\CreateDtoFactory::fromRequest($request)
        );

        return response()->noContent();
    }

    public function delete(Request $request){
        app(Contracts\DeleteEmployee::class)->execute($request->employee_id);

        return response()->noContent();
    }

}

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

        app(Contracts\AddEmployee::class)->execute(
            $request->phone_number,
            $request->name,
            $request->position,
            Hash::make($request->password),
            $request->permissions
        );

    }

}

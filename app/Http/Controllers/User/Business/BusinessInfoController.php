<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Resources;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tasks;

class BusinessInfoController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();

        $business = ($user->hasRole('employee')) ? $this->getBusinessIdByEmployee($user) : $this->getBusinessIdByBusiness($user);

        return Resources\User\Business\CompanyInformation\InfoResource::collection(Business::find($business));
    }

    public function getBusinessIdByEmployee($user){
        return app(Tasks\Employee\FindTask::class)->run(
            $user->id
        );
    }

    public function getBusinessIdByBusiness($user){
        return app(Tasks\Business\FindTask::class)->run(
            $user->id
        );
    }
}

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
        $business = app(Tasks\Business\FindTask::class)->run(Auth::user()->id);
        return Resources\User\Business\CompanyInformation\InfoResource::collection(Business::find($business));
    }
}

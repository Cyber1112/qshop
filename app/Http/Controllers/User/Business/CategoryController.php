<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Tasks;
use App\Helpers;

class CategoryController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function addCategory(Request $request): \Illuminate\Http\JsonResponse|Response
    {
        $user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user(), 'edit profile');

        app(Contracts\BusinessCategory::class)->execute(
            $request->categories,
            $user
        );

        return response()->noContent();
    }


}

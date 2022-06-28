<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts;

class CategoryController extends Controller
{
    public function addCategory(Request $request): \Illuminate\Http\Response
    {

        app(Contracts\BusinessCategory::class)->execute(
            $request->categories
        );

        return response()->noContent();
    }
}

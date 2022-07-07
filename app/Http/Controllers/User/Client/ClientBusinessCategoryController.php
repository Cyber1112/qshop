<?php

namespace App\Http\Controllers\User\Client;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Contracts;
use App\Tasks;
use App\Http\Resources;

class ClientBusinessCategoryController extends Controller
{

    public function index(Request $request, SubCategory $category){
        $response = app(Contracts\GetClientBusinessCategory::class)->execute($category->id);
        return response()->json($response);
    }

    public function showBusinessAbout(Request $request, Business $business){
        return new Resources\User\Client\BusinessAbout\InfoResource($business);
    }

}

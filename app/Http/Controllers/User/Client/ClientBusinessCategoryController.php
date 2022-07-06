<?php

namespace App\Http\Controllers\User\Client;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Contracts;
use App\Tasks;

class ClientBusinessCategoryController extends Controller
{
    public function index(Request $request, SubCategory $category){
        return app(Contracts\GetClientBusinessCategory::class)->execute($category->id);
    }
}

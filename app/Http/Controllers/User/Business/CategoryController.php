<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Contracts;
use Illuminate\Http\Response;
use App\Tasks;
use App\Http\Resources;

class CategoryController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function addCategory(Request $request): \Illuminate\Http\JsonResponse|Response
    {

        app(Contracts\BusinessCategory::class)->execute(
            $request->categories,
        );

        return response()->noContent();
    }

    public function showCategories(Request $request){
        return Resources\Category\CategoriesResource::collection(Category::all());
    }

    public function showSubCategories(Request $request, $id){
        return Resources\Category\SubCategoriesResource::collection(SubCategory::where('category_id', $id)->get());
    }



}

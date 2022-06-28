<?php

use App\Http\Controllers\User\Account\ProfileController;
use App\Http\Controllers\User\Business\BusinessInfoController;
use App\Http\Controllers\User\Business\CategoryController;
use App\Http\Controllers\User\Business\CityController;
use App\Http\Controllers\User\Business\DescriptionController;
use App\Http\Controllers\User\Business\EmployeeController;
use App\Http\Controllers\User\Business\ScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\Business\ContactController;
//use App\Http\Controllers\User\Account\ProfileController;
//use App\Http\Controllers\User\Business\CreateEmployeeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', [LoginController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    // Business
    Route::get('/get-all-cities', [\App\Http\Controllers\City\CityController::class, 'index']);

    Route::prefix('account')->group(function() {
        Route::get('profile', [ProfileController::class, 'index']);
        Route::post('update', [ProfileController::class, 'updateProfile']);
    });

    Route::prefix('business')->group(function () {
        Route::post('/create-address', [ContactController::class, 'createContact']);
        Route::post('/create-description', [DescriptionController::class, 'createDescrption']);
        Route::post('/create-city', [CityController::class, 'addCity']);
        Route::post('/create-category', [CategoryController::class, 'addCategory']);
        Route::post('/create-schedule', [ScheduleController::class, 'addSchedule']);
        Route::get('/get-info', [BusinessInfoController::class, 'index']);
        Route::post('/create-employee', [EmployeeController::class, 'create']);
    });

//    Employee
    Route::prefix('employee')->group(function () {
        Route::get('/get-info', [EmployeeController::class, 'index']);
    });

    // Client
    Route::prefix('client')->group(function () {

    });

    // Admin
    Route::prefix('admin')->group(function () {

    });

    Route::post('/logout', [\App\Http\Controllers\Auth\LogoutController::class, 'logout']);

});

<?php

use App\Http\Controllers\User\Account\ProfileController;
use App\Http\Controllers\User\Business\BonusController;
use App\Http\Controllers\User\Business\BusinessClientBonusController;
use App\Http\Controllers\User\Business\BusinessInfoController;
use App\Http\Controllers\User\Business\CategoryController;
use App\Http\Controllers\User\Business\CityController;
use App\Http\Controllers\User\Business\DescriptionController;
use App\Http\Controllers\User\Business\EmployeeController;
use App\Http\Controllers\User\Business\ScheduleController;
use App\Http\Controllers\User\Business\StatisticsController;
use App\Http\Controllers\User\Business\TransactionHistoryCommentController;
use App\Http\Controllers\User\Business\TransactionHistoryController;
use App\Http\Controllers\User\Client\ClientInfoController;
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
        Route::prefix('address')->group(function (){
            Route::post('/create', [ContactController::class, 'createContact']);
        });
        Route::prefix('description')->group(function (){
            Route::post('/create', [DescriptionController::class, 'createDescrption']);
        });
        Route::prefix('city')->group(function (){
            Route::post('/create', [CityController::class, 'addCity']);
        });
        Route::prefix('category')->group(function (){
            Route::post('/create', [CategoryController::class, 'addCategory']);
            Route::get('/get', [CategoryController::class, 'showCategories']);
            Route::get('/get/{id}', [CategoryController::class, 'showSubCategories']);
        });
        Route::prefix('schedule')->group(function (){
            Route::post('/create', [ScheduleController::class, 'addSchedule']);
        });
        Route::get('/get-info', [BusinessInfoController::class, 'index']);
        Route::post('/create-bonus', [BonusController::class, 'createBonus']);

        Route::prefix('employee')->group(function(){
            Route::post('/create', [EmployeeController::class, 'create']);
            Route::post('/delete', [EmployeeController::class, 'delete']);
            Route::get('/get', [EmployeeController::class, 'index']);
        });

        Route::prefix('transaction')->group(function(){
            Route::get('/get', [TransactionHistoryController::class, 'getAll']);
            Route::get('/get/{history}', [TransactionHistoryController::class, 'get']);
            Route::get('/get-between-date', [TransactionHistoryController::class, 'getTransactionBetweenDate']);
            Route::post('/delete/{id}', [TransactionHistoryController::class, 'delete']);
            Route::post('/create-transaction', [TransactionHistoryController::class, 'createTransaction']);
            Route::post('/create-comment/{transaction}', [TransactionHistoryCommentController::class, 'create']);
        });

        Route::prefix('business-client')->group(function(){
            Route::get('/get-info', [BusinessClientBonusController::class, 'get']);
            Route::post('/write-off-transaction', [BusinessClientBonusController::class, 'writeOffTransaction']);
        });

        Route::prefix('statistics')->group(function(){
            Route::get('/get', [StatisticsController::class, 'index']);
        });

    });

    // Client
    Route::prefix('client')->group(function () {
        Route::prefix('profile')->group(function(){
            Route::get('/get', [ClientInfoController::class, 'index']);
            Route::post('/update', [ClientInfoController::class, 'updateProfile']);
            Route::post('/delete-avatar', [ClientInfoController::class, 'deleteAvatar']);
        });
    });

    // Admin
    Route::prefix('admin')->group(function () {

    });

    Route::post('/logout', [\App\Http\Controllers\Auth\LogoutController::class, 'logout']);

});

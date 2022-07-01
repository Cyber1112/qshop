<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessTransaction\CreateRequest;
use App\Dto;
use App\Tasks;
use Illuminate\Support\Facades\Auth;
use App\Contracts;
use Illuminate\Http\Request;

class TransactionHistoryController extends Controller
{

    public function createTransaction(CreateRequest $request){
        $user = Auth::user();

        $data = Dto\BusinessTransaction\CreateDtoFactory::fromRequest($request);

        $clientExist = $this->checkNumber($data->phone_number);
        if (!$clientExist){
            return response()->json(['message' => "The user with number $data->phone_number is not found" ], 404);
        }
        $client_id = $this->getClientId($clientExist);

        if ( $user->hasRole('employee') ){
            if($user->hasPermissionTo('manipulate bonus')){
                return $this->sendBonus(
                    $data,
                    $this->getBusinessIdByEmployee($user),
                    $client_id,
                );
            }
            return response()->json(['message' => "You are not given permission to manipulate bonus"], 401);
        }

        return $this->sendBonus($data, $this->getBusinessIdByBusiness($user), $client_id);


    }

//    public function writeOffTransaction(Request $request){
//        $clientExist = $this->checkNumber($request->phone_number);
//        if (!$clientExist){
//            return response()->json(['message' => "The user with number $request->phone_number is not found" ], 404);
//        }
//        $client_id = $this->getClientId($clientExist);
//
//
//
//        return response()->noContent();
//    }

    public function getClientId($client_id){
        return app(Tasks\Client\FindTask::class)->run($client_id)->id;
    }

    public function checkBalance($business_id, $purchase_amount){
        $balance = app(Tasks\Business\FindTask::class)->run($business_id)->balance;
        if ( $purchase_amount > $balance ){
            return false;
        }
        return true;
    }

    public function sendBonus($dto, $business_id, $client_id){
        if ( $this->checkBalance($business_id, $dto->purchase_amount) ){
            app(Contracts\Transaction::class)->execute($dto, $business_id, $client_id);
            return response()->noContent();
        }
        return response()->json(['message' => "Not enough money"], 405);
    }

    public function checkNumber($phone_number){
        return app(Tasks\User\FindByPhoneTask::class)->run($phone_number)->id;
    }

    public function getBusinessIdByEmployee($user){
        return app(Tasks\Employee\FindTask::class)->run(
            $user->id
        )->business_id;
    }

    public function getBusinessIdByBusiness($user){
        return app(Tasks\Business\FindTask::class)->run(
            $user->id
        )->id;
    }

}

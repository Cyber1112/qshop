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
            return $this->sendByEmployee(
                $data,
                $this->getBusinessIdByEmployee($user),
                $client_id,
                $user
            );
        }

        return $this->sendByBusiness(
            $data,
            $this->getBusinessIdByBusiness($user),
            $client_id
        );
    }

    public function writeOffTransaction(Request $request){
        $clientExist = $this->checkNumber($request->phone_number);
        if (!$clientExist){
            return response()->json(['message' => "The user with number $request->phone_number is not found" ], 404);
        }
        $client_id = $this->getClientId($clientExist);

        app(Contracts\WriteOffBonusFromClient::class)->execute(
            $client_id,
            $request->bonus_amount
        );

        return response()->noContent();
    }

    public function getClientId($client_id){
        return app(Tasks\Client\FindTask::class)->run($client_id)->id;
    }

    public function sendByEmployee($data, $business_id, $client_id, $user){
        if ( $user->hasPermissionTo('manipulate bonus') ){
            if ( $this->checkBalance($business_id, $data->purchase_amount) ){
                return $this->sendBonus(
                    $data,
                    $business_id,
                    $client_id
                );
            }
            return response()->json(['message' => "Not enough money"], 403);
        }
        return response()->json(['message' => "You are not given permission to manipulate bonus"], 401);
    }

    public function sendByBusiness($data, $business_id, $client_id){
        if ( $this->checkBalance($business_id, $data->purchase_amount) ){
            return $this->sendBonus(
                $data,
                $business_id,
                $client_id
            );
        }
        return response()->json(['message' => "Not enough money"], 403);
    }

    public function checkBalance($business_id, $purchase_amount){
        $balance = app(Tasks\Business\FindTask::class)->run($business_id)->balance;
        if ( $purchase_amount > $balance ){
            return false;
        }
        return true;
    }

    public function sendBonus($dto, $business_id, $client_id){
        app(Contracts\Transaction::class)->execute($dto, $business_id, $client_id);
        return response()->noContent();
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

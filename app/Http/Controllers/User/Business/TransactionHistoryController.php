<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessTransaction\CreateRequest;
use App\Dto;
use App\Models\Business;
use App\Models\TransactionHistory;
use App\Tasks;
use Illuminate\Support\Facades\Auth;
use App\Contracts;
use Illuminate\Http\Request;
use App\Helpers;
use App\Http\Resources;

class TransactionHistoryController extends Controller
{

    public function getAll(Request $request){
        $user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
        return Resources\User\Business\Transactions\InfoResource::collection(TransactionHistory::where('business_id', $user)
            ->paginate(10));
    }

    public function getTransactionBetweenDate(Request $request){
        return app(Contracts\GetBusinessTransactionsBetweenDate::class)->execute($request->from, $request->to);

    }

    public function get(Request $request, TransactionHistory $history){
        return Resources\User\Business\Transactions\InfoResource::collection([$history]);
    }

    public function delete($id){
        app(Contracts\DeleteTransaction::class)->execute($id);
        return response()->noContent();
    }

    public function createTransaction(CreateRequest $request){
        $user = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());

        $data = Dto\BusinessTransaction\CreateDtoFactory::fromRequest($request);

        $clientExist = app(Tasks\User\FindByPhoneTask::class)->run($data->phone_number)->id;
        if (!$clientExist){
            return response()->json(['message' => "The user with number $data->phone_number is not found" ], 404);
        }
        $client_id = app(Tasks\Client\FindTask::class)->run($clientExist)->id;

//        CHECK BALANCE
        if( app(Tasks\Business\FindTask::class)->run($user)->balance > $data->purchase_amount ){
            app(Contracts\Transaction::class)->execute($data, $user, $client_id);
            return response()->noContent();
        }

        return response()->json(['message' => "Not enough money"], 405);
    }



}

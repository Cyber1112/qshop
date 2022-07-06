<?php

namespace App\Http\Controllers\User\Client;

use App\Http\Controllers\Controller;
use App\Models\BusinessClientWroteOffTransactions;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use App\Contracts;
use App\Http\Resources;

class ClientTransactionsController extends Controller
{

    public function index(Request $request){
        return app(Contracts\GetAccruedAndWrittenOffTransactions::class)->execute($request->from, $request->to);
    }

    public function showDetailOfAccruedBonus(Request $request, TransactionHistory $history){
        return Resources\User\Client\Transaction\AccruedBonusResource::collection([$history]);
    }

    public function showDetailOfWrittenOffBonus(Request $request, BusinessClientWroteOffTransactions $writtenBonus){
        return Resources\User\Client\Transaction\WrittenOffBonusResource::collection([$writtenBonus]);
    }

}

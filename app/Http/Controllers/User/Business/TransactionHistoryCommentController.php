<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts;

class TransactionHistoryCommentController extends Controller
{
    public function create(Request $request, $transaction_id){
        app(Contracts\TransactionComments::class)->execute(
            $request->comment,
            $transaction_id
        );
        return response()->noContent();
    }
}

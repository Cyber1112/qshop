<?php

namespace App\Http\Controllers\User\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources;
use App\Contracts;
use App\Helpers;

class ClientInfoController extends Controller
{

    public function index(Request $request){
        return Resources\User\Client\Account\ProfileResources::collection(User::find(Auth::user()));
    }

    public function updateProfile(Request $request): Response
    {
        app(Contracts\UserAccount::class)->execute($request);
        return response()->noContent();
    }

    public function deleteAvatar(){
        app(Contracts\DeleteAvatar::class)->execute();
        return response()->noContent();
    }

}

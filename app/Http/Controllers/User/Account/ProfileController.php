<?php

namespace App\Http\Controllers\User\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources;
use App\Contracts;
use App\Tasks;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return Resources\User\Business\Account\ProfileResource::collection(User::find(Auth::user()));
    }

    public function updateProfile(Request $request): Response
    {
        app(Contracts\UserAccount::class)->execute($request);
        return response()->noContent();
    }
}

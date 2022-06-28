<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts;
use Illuminate\Http\Response;

class LogoutController extends Controller
{
    public function logout(Request $request): Response
    {
        app(Contracts\Logout::class)->execute();

        return response()->noContent();
    }
}

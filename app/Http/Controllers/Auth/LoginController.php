<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests as Requests;
use Illuminate\Http\JsonResponse;
use App\Contracts;

class LoginController extends Controller
{
    public function login(Requests\Login\LoginRequest $request): JsonResponse
    {
        $response = app(Contracts\Login::class)->execute(
            $request->get('phone_number'),
            $request->get('password')
        );

        return response()->json($response);
    }
}

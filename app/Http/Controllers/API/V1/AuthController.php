<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Helpers\API\Response;
use App\Http\Requests\API\LoginRequest;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if(!Auth::attempt($credentials)){
            return Response::response(null, "Login Failed", ["Login failed"], Response::BAD_REQUEST);
        }

        $user = Auth::user();
        // generate token
        $token = $user->createToken('access-token')->plainTextToken;

        $data = ['access_token' => $token, 'user' => $user];
        return Response::response($data, "User Logedin Successfully", null, Response::SUCCESS);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = [
                    'user' => $user,
                    'token' => $token,
                    'status' => 200
                ];
                return response()->json($response, 200);
             } else {
                return response()->json([
                    'message' => 'Wrong username or password',
                    'status' => 422
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Wrong username or password',
                'status' => 422
            ]);
        }
    }

    public function logout(Request $request) {
        $token = $request->user()->token();
        $token->revoke();

        return response()->json(['status' => 200], 200);
    }
}

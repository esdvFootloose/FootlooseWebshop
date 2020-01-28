<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Psr\Http\Message\ResponseInterface;
use stdClass;

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
                    'status' => 200,
                ];
                return response()->json($response, 200);
            } else {
                return response()->json([
                    'message' => 'Wrong username or password',
                    'status' => 422,
                ]);
            }
        } else {
            $client = new Client(['base_uri' => 'http://10.3.3.11:5000/']);
            $post_body = new stdClass;
            $post_body->key = env('FOOTLOOSE_AUTH_KEY');
            $post_body->username = $request->username;
            $post_body->password = $request->password;
            if ($request->code) {
                $post_body->otp = $request->code;
            }

            $user = json_decode($client->request('POST', 'login', [
                'json' => $post_body,
            ])->getBody()->getContents());

            if ($user) {
                $temp_user = new User([
                    'email' => $user->username.'@esdvfootloose.nl',
                    'name' => $user->username
                ]);
                $token = $temp_user->createToken('Laravel Password Grant Client')->accessToken;
                $response = [
                    'user' => $user,
                    'token' => $token,
                    'status' => 200,
                ];
                return response()->json($response, 200);
            }

            return response()->json([
                'message' => 'Wrong username or password',
                'status' => 422,
            ]);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();

        return response()->json(['status' => 200], 200);
    }
}

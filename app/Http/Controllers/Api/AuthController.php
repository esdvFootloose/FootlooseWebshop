<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Right;
use App\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use stdClass;

class AuthController extends Controller
{

    private function getFLUser(Request $request)
    {
        $client = new Client(['base_uri' => 'http://10.3.3.11:5000/']);
        $post_body = new stdClass;
        $post_body->key = env('FOOTLOOSE_AUTH_KEY');
        $post_body->username = $request->username;
        $post_body->password = $request->password;

        if ($request->code) {
            $post_body->otp = $request->code;
        }

        $fl_user = json_decode($client->request('POST', 'login', [
            'json' => $post_body,
        ])->getBody()->getContents());

        if ($fl_user) {
            unset($post_body->password);
            unset($post_body->otp);
            return json_decode($client->request('GET', 'user/info', [
                'query' => (array) $post_body,
            ])->getBody()->getContents())[0];

        }
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        
        try {
            $fl_user = $this->getFLUser($request);
        } catch (Exception $exception) {
            $exception = $exception;
        }

        if ($user && !$fl_user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = [
                    'user' => $user,
                    'token' => $token,
                    'status' => 200,
                ];
                return response()->json($response, 200);
            }
        } else if ($fl_user && $user) {
            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
            $response = [
                'user' => $user,
                'token' => $token,
                'status' => 200,
            ];
            return response()->json($response, 200);
        } else if ($fl_user && !$user) {
            $user = User::where('email', $fl_user->email)->first();
            if (!$user) {
                $user = new User([
                    'email' => $fl_user->email,
                    'name' => $fl_user->first_name . " " . $fl_user->last_name,
                    'password' => Hash::make($request->password),
                ]);
                $user->save();
                $user->roles()->attach(Right::where('name', 'user')->first());
            }

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
                'error' => $exception,
                'status' => 422,
            ],422);
        }

    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();

        return response()->json(['status' => 200], 200);
    }
}

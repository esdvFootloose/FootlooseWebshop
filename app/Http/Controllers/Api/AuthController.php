<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\Cast\Bool_;
use stdClass;

class AuthController extends Controller
{

    private function getFLUser(Request $request, $needs_attributes)
    {
        $client = new Client(['base_uri' => 'http://10.3.3.11:5000/']);
        $post_body = new stdClass;
        $post_body->key = env('FOOTLOOSE_AUTH_KEY');
        $post_body->username = $request->username;
        $post_body->password = $request->password;
        if ($request->code) {
            $post_body->otp = $request->code;
        }

        if ($needs_attributes) {
            return json_decode($client->request('GET', 'user/info', [
                'query' => (array) $post_body,
            ])->getBody()->getContents());
        } else {
            return json_decode($client->request('POST', 'login', [
                'json' => $post_body,
            ])->getBody()->getContents());
        }
    }

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
                $fl_user = $this->getFLUser($request, false);

                if ($fl_user) {
                    $user->password = Hash::make($request->password);
                }

                return response()->json([
                    'message' => 'Wrong username or password',
                    'status' => 422,
                ]);
            }
        } else {

            $fl_user = $this->getFLUser($request, true);

            if ($fl_user) {
                $user = new User([
                    'email' => $fl_user->email,
                    'name' => $fl_user->first_name . " " . $fl_user->last_name,
                    'password' => Hash::make($request->password),
                ]);
                $user->save();

                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
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

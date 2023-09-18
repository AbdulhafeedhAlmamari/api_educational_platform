<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
// use App\Models\User;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Support\Facades\Auth;
// use Laravel\Passport\HasApiTokens;

class PassportAuthController extends Controller
{
    use ApiResponseTrait;
    public function register(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:6|confirmed',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        $token = $user->createToken('apppppppppp')->accessToken;

        return response()->json(['token' => $token], 201);
    }

    public function register2(Request $request)
    {
        $user = $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $token = $user->createToken('key')->accessToken;
        return $this->apiResponse($token, 'Token', Response::HTTP_OK);
    }

    public function login(Request $request)
    {
        $user =[
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (auth()->attempt($user)) {
            
            $token = auth()->user()->createToken('apppppppppp')->accessToken;
            return $this->apiResponse($token, 'Token', Response::HTTP_OK);
        }
        return $this->apiResponse(null, 'Unauthorised', Response::HTTP_NOT_FOUND);
    }

    public function logout()
    {
        auth()->logout();
        $this->apiResponse(null, 'User successfully signed out', Response::HTTP_OK);
    }
    public function logout2 (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

    public function userInfo(Request $request)
    {
        $user = auth()->user();
        return $this->apiResponse($user, 'Token', Response::HTTP_OK);
    }
}

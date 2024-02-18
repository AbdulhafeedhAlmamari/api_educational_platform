<?php

// namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Controller;
// use App\Models\User;
// use Dotenv\Validator;
// use Illuminate\Http\Request;
// // use App\Http\Controllers\Controller;
// // use App\Models\User;
// // use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Symfony\Component\HttpFoundation\Response;
// // use Laravel\Passport\HasApiTokens;
// use Laravel\Passport\Passport;
// use Laravel\Socialite\Facades\Socialite;

// class   PassportAuthController extends Controller
// {
//     use ApiResponseTrait;
//     public function register(Request $request)
//     {
//         // $validator = Validator::make($request->all(), [
//         //     'name' => 'required|string|max:255',
//         //     'email' => 'required|string|email|max:255|unique:users',
//         //     'password' => 'required|string|min:6|confirmed',
//         // ]);

//         // if ($validator->fails()) {
//         //     return response()->json(['errors' => $validator->errors()], 422);
//         // }

//         $user = User::create([
//             'name' => $request->input('name'),
//             'email' => $request->input('email'),
//             'password' => $request->input('password'),
//         ]);

//         $token =$user->createToken('MyApp', ['user'])->accessToken;
//         $user->sendEmailVerificationNotification();

//         return response()->json(['token' => $token], 201);
//     }

//     // public function register2(Request $request)
//     // {
//     //     $user = $user = User::create([
//     //         'name' => $request->name,
//     //         'email' => $request->email,
//     //         'password' => $request->password,
//     //     ]);
//     //     $token = $user->createToken('key')->accessToken;
//     //     return $this->apiResponse($token, 'Token', Response::HTTP_OK);
//     // }
//     // public function login(Request $request)
//     // {
//     //     // $validator = Validator($request->all(), [
//     //     //     'email' => 'required|email',
//     //     //     'password' => 'required',
//     //     // ]);

//     //     // if ($validator->fails()) {
//     //     //     return response()->json(['error' => $validator->errors()->all()]);
//     //     // }

//     //     if (auth()->guard('user_api')->attempt(['email' => request('email'), 'password' => request('password')])) {

//     //         config(['auth.guards.api.provider' => 'user_api']);

//     //         $user = User::select('users.*')->find(auth()->guard('user_api')->user()->id);
//     //         $success =  $user;
//     //         $success['token'] =  $user->createToken('MyApp', ['user_api'])->accessToken;

//     //         return response()->json($success, 200);
//     //     } else {
//     //         return response()->json(['error' => ['Email and Password are Wrong.']], 200);
//     //     }
//     // }
//     public function login(Request $request)
//     {
//         // $validator = Validator($request->all(), [
//         //     'email' => 'required|email',
//         //     'password' => 'required',
//         // ]);

//         // if ($validator->fails()) {
//         //     return response()->json(['error' => $validator->errors()->all()]);
//         // }

//         $credentials = $request->only('email', 'password');
//         // dd(Auth::guard('user_api')->validate($credentials));
//         if (auth()->guard('user')->attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
//             // config(['auth.guards.api.provider' => 'user_api']);
//             $client = Auth::guard('user')->user();
//             $token = $client->createToken('MyApp', ['user_api'])->accessToken;

//             return response()->json([
//                 'message' => 'Client logged in successfully',
//                 'token' => $token
//             ], 200);
//         } else {
//             return response()->json(['error' => 'Invalid credentials'], 401);
//         }
//     }



//     public function logout()
//     {
//         auth()->logout();
//         $this->apiResponse(null, 'User successfully signed out', Response::HTTP_OK);
//     }
//     public function logout2(Request $request)
//     {
//         $token = $request->user()->token();
//         $token->revoke();
//         $response = ['message' => 'You have been successfully logged out!'];
//         return response($response, 200);
//     }

//     public function userInfo(Request $request)
//     {
//         $user = auth()->user();
//         return $this->apiResponse($user, 'Token', Response::HTTP_OK);
//     }
// }

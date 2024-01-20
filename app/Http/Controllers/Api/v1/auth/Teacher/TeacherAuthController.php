<?php

namespace App\Http\Controllers\Api\v1\auth\Teacher;

use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sections\CreateSectionRequest;
use App\Http\Requests\TeacherRequest;
use App\Http\Requests\Teachers\CreateTeacherRequest;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\Request;
// use App\Models\User;
use Dotenv\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Passport\Passport;
use Laravel\Socialite\Facades\Socialite;

class TeacherAuthController extends Controller
{
    use ApiResponseTrait;
    public function register(CreateTeacherRequest $request)
    {

        try {
            $credentials = $request->only('name', 'email', 'gender', 'phone_number', 'address', 'password', 'url_image');
            $teacher = new TeacherResource(Teacher::create([
                'name' => $credentials['name'],
                'email' => $credentials['email'],
                'gender' => $credentials['gender'],
                'phone_number' => $credentials['phone_number'],
                'address' => $credentials['address'],
                // 'password' =>  Hash::make($credentials['password']),
                'password' => $credentials['password'],
                'url_image' => $credentials['url_image'],
            ]));

            $token = $teacher->createToken('TeacherToken', ['teacher'])->accessToken;
            event(new Registered($teacher));
            // $teacher->SendEmailVerificationNotification();

            return $this->apiResponse($token, 'تم إنشاء حساب بنجاح', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // $email = Teacher::where('email', $credentials['email'])->first();
        if (Auth::guard('teacher')->attempt(['email' => $credentials['email'], 'password' =>  $credentials['password']])) {
            // $client = Auth::guard('user')->user();
            config(['auth.guards.api.provider' => 'teacher']);
            // $token = $client->createToken('TeacherToken', ['teacher_api'])->accessToken;
            $token = Auth::guard('teacher')->user()->createToken('TeacherToken', ['teacher'])->accessToken;

            return response()->json([
                'message' => 'تم تسجيل الدخول بنجاح',
                'token' => $token
            ], 200);
        } else {
            return response()->json(['error' => 'خطاء في الايميل او كلمة المرور'], 401);
        }
    }

    // public function logout()
    // {
    //     auth()->logout();
    //     $this->apiResponse(null, 'User successfully signed out', Response::HTTP_OK);
    // }

    public function redirect()
    {
        // $user=Socialite::driver('google')->user();
        // $findUser=User::where( 'email', $user->email)->first();
        // if( !$findUser)
        // $findUser=new User();
        // $findUser->name;
        // $findUser->email=$user->email;
        // $findUser->picture=$user->avatar;
        // $findUser->save();
        // $googleTeacher = Socialite::driver('google')->stateless()->redirect();
        // return dd( $googleTeacher);
        return  $googleUser = Socialite::driver('google')->stateless()->redirect();
        // return Socialite::driver('google')->redirect();
        // return dd(Socialite::driver('google')->user());
    }
    public function callback()
    {

        try {
            $googleTeacher = Socialite::driver('google')->stateless()->user();

            // Check for existing user or create a new one
            $existingTeacher = Teacher::where('email', $googleTeacher->email)->first();

            if (!$existingTeacher) {
                $newTeacher = Teacher::create([
                    'name' => $googleTeacher->name,
                    'email' => $googleTeacher->email,
                    'gender' => 1,
                    'phone_number' => '77',
                    'address' => 'add',
                    'password' => '123456',
                    'url_image' =>  $googleTeacher->avatar,
                    // 'email_verified_at' => now(),
                    // 'social_id' => $googleTeacher->id,
                    // 'social_type' =>  'google',
                ]);
                // Optionally store access token if needed
            }
            $token = $existingTeacher ? $existingTeacher->createToken('TeacherToken', ['teacher'])->accessToken: $newTeacher->createToken('TeacherToken', ['teacher'])->accessToken;

            // $token = $existingTeacher ?: $newTeacher->createToken('Personal Access Token')->accessToken;
            // Log in the user
            // Auth::login($existingTeacher ?: $newTeacher);
            Auth::guard('teacher')->login($existingTeacher ?: $newTeacher);
            return $this->apiResponse($googleTeacher,  $token, Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'Authentication failed', Response::HTTP_INTERNAL_SERVER_ERROR);
        }


        // $googleTeacher = Socialite::driver('google')->stateless()->user();
        // return dd($googleTeacher);

        // $googleTeacher = Socialite::driver('google')->stateless()->user();
        // // $credentials = $request->only('name', 'email', 'gender', 'phone_number', 'address', 'password', 'url_image');
        // $teacher = Teacher::create([
        //     'name' => $googleTeacher->name,
        //     'email' => $googleTeacher->email,
        //     'gender' => 1,
        //     'phone_number' => '77',
        //     'address' => 'add',
        //     'password' => '123456',
        //     'url_image' =>  $googleTeacher->avatar,
        //     // 'email_verified_at' => now(),
        // ]);
        // dd($teacher);
        // return Auth::guard('teacher')->login($teacher);


        // try {
        //     $googleTeacher = Socialite::driver('google')->stateless()->user();

        //     // Check for existing user or create a new one
        //     $existingTeacher = Teacher::where('email', $googleTeacher->email)->first();

        //     if (!$existingTeacher) {
        //         $newTeacher = Teacher::create([
        //             'name' => $googleTeacher->name,
        //             'email' => $googleTeacher->email,
        //             'gender' => $googleTeacher->user['gender'],
        //             'phone_number' => $googleTeacher->user['phone_number'],
        //             'address' => $googleTeacher->user['address'],
        //             'password' => '123456',
        //             'url_image' =>  $googleTeacher->avatar,
        //             'email_verified_at' => now(),
        //             'social_id' => $googleTeacher->id,
        //             'social_type' =>  'google',
        //         ]);
        //         // Optionally store access token if needed
        //     }
        //     $token = $existingUser ?: $newUser->createToken('Personal Access Token')->accessToken;
        //     // Log in the user
        //     // Auth::login($existingTeacher ?: $newTeacher);
        //     Auth::guard('teacher')->login($existingTeacher ?: $newTeacher);
        //     // Return a success response or redirect
        //     // return response()->json([
        //     //     'message' => 'Login successful',
        //     //     'user' => $googleTeacher,
        //     // ], 200);
        //     return $this->apiResponse($googleTeacher, 'Login successful', Response::HTTP_OK);
        // } catch (\Exception $e) {
        //     // Handle authentication errors
        //     // return response()->json([
        //     //     'message' => 'Authentication failed',
        //     //     'error' => $e->getMessage(),
        //     // ], 401);
        //     return $this->apiResponse($e->getMessage(), 'Authentication failed', Response::HTTP_INTERNAL_SERVER_ERROR);
        // }
    }
    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'تم تسجيل الخروج بنجاح'];
        // return response($response, 200);
        return $this->apiResponse(null, $response, Response::HTTP_OK);
    }

    public function userInfo(Request $request)
    {
        $user = auth()->user();
        return $this->apiResponse($user, 'Token', Response::HTTP_OK);
    }
}

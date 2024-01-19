<?php

namespace App\Http\Controllers\Api\v1\auth\Student;

use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sections\CreateSectionRequest;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\Students\CreateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
// use App\Models\User;
use Dotenv\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Passport\Passport;
use Laravel\Socialite\Facades\Socialite;

class StudentAuthController extends Controller
{
    use ApiResponseTrait;
    public function register(CreateStudentRequest $request)
    {

        try {
            $credentials = $request->only('name', 'email', 'gender', 'phone_number', 'address', 'password', 'url_image');
            $student = new StudentResource(Student::create([
                'name' => $credentials['name'],
                'email' => $credentials['email'],
                'gender' => $credentials['gender'],
                'phone_number' => $credentials['phone_number'],
                'address' => $credentials['address'],
                // 'password' =>  Hash::make($credentials['password']),
                'password' => $credentials['password'],
                'url_image' => $credentials['url_image'],
            ]));

            $token = $student->createToken('StudentToken', ['student'])->accessToken;
            event(new Registered($student));
            // $student->SendEmailVerificationNotification();

            return $this->apiResponse($token, 'تم إنشاء حساب بنجاح', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // $email = Student::where('email', $credentials['email'])->first();
        if (Auth::guard('student')->attempt(['email' => $credentials['email'], 'password' =>  $credentials['password']])) {
            // $client = Auth::guard('user')->user();
            config(['auth.guards.api.provider' => 'student']);
            // $token = $client->createToken('StudentToken', ['student_api'])->accessToken;
            $token = Auth::guard('student')->user()->createToken('StudentToken', ['student'])->accessToken;

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
        // $googleStudent = Socialite::driver('google')->stateless()->redirect();
        // return dd( $googleStudent);
        return  $googleUser = Socialite::driver('google')->stateless()->redirect();
        // return Socialite::driver('google')->redirect();
        // return dd(Socialite::driver('google')->user());
    }
    public function callback()
    {

        try {
            $googleStudent = Socialite::driver('google')->stateless()->user();

            // Check for existing user or create a new one
            $existingStudent = Student::where('email', $googleStudent->email)->first();

            if (!$existingStudent) {
                $newStudent = Student::create([
                    'name' => $googleStudent->name,
                    'email' => $googleStudent->email,
                    'gender' => 1,
                    'phone_number' => '77',
                    'address' => 'add',
                    'password' => '123456',
                    'url_image' =>  $googleStudent->avatar,
                    // 'email_verified_at' => now(),
                    // 'social_id' => $googleStudent->id,
                    // 'social_type' =>  'google',
                ]);
                // Optionally store access token if needed
            }
            $token = $existingStudent ? $existingStudent->createToken('StudentToken', ['student'])->accessToken: $newStudent->createToken('StudentToken', ['student'])->accessToken;

            // $token = $existingStudent ?: $newStudent->createToken('Personal Access Token')->accessToken;
            // Log in the user
            // Auth::login($existingStudent ?: $newStudent);
            Auth::guard('student')->login($existingStudent ?: $newStudent);
            return $this->apiResponse($googleStudent,  $token, Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'Authentication failed', Response::HTTP_INTERNAL_SERVER_ERROR);
        }


        // $googleStudent = Socialite::driver('google')->stateless()->user();
        // return dd($googleStudent);

        // $googleStudent = Socialite::driver('google')->stateless()->user();
        // // $credentials = $request->only('name', 'email', 'gender', 'phone_number', 'address', 'password', 'url_image');
        // $student = Student::create([
        //     'name' => $googleStudent->name,
        //     'email' => $googleStudent->email,
        //     'gender' => 1,
        //     'phone_number' => '77',
        //     'address' => 'add',
        //     'password' => '123456',
        //     'url_image' =>  $googleStudent->avatar,
        //     // 'email_verified_at' => now(),
        // ]);
        // dd($student);
        // return Auth::guard('student')->login($student);


        // try {
        //     $googleStudent = Socialite::driver('google')->stateless()->user();

        //     // Check for existing user or create a new one
        //     $existingStudent = Student::where('email', $googleStudent->email)->first();

        //     if (!$existingStudent) {
        //         $newStudent = Student::create([
        //             'name' => $googleStudent->name,
        //             'email' => $googleStudent->email,
        //             'gender' => $googleStudent->user['gender'],
        //             'phone_number' => $googleStudent->user['phone_number'],
        //             'address' => $googleStudent->user['address'],
        //             'password' => '123456',
        //             'url_image' =>  $googleStudent->avatar,
        //             'email_verified_at' => now(),
        //             'social_id' => $googleStudent->id,
        //             'social_type' =>  'google',
        //         ]);
        //         // Optionally store access token if needed
        //     }
        //     $token = $existingUser ?: $newUser->createToken('Personal Access Token')->accessToken;
        //     // Log in the user
        //     // Auth::login($existingStudent ?: $newStudent);
        //     Auth::guard('student')->login($existingStudent ?: $newStudent);
        //     // Return a success response or redirect
        //     // return response()->json([
        //     //     'message' => 'Login successful',
        //     //     'user' => $googleStudent,
        //     // ], 200);
        //     return $this->apiResponse($googleStudent, 'Login successful', Response::HTTP_OK);
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

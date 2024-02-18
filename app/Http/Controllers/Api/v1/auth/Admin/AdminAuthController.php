<?php

namespace App\Http\Controllers\Api\v1\auth\Admin;

use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Controllers\Controller;
// use App\Http\Requests\Sections\CreateSectionRequest;
use App\Http\Requests\AdminRequest;
// use App\Http\Requests\Admins\CreateAdminRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Request;
// use Dotenv\Validator;
// use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
// use Laravel\Passport\Passport;
use Laravel\Socialite\Facades\Socialite;

class AdminAuthController extends Controller
{
    use ApiResponseTrait;
    public function register(AdminRequest $request)
    {

        try {
            $credentials = $request->only('name', 'email', 'gender', 'phone_number', 'address', 'password', 'url_image');
            $admin = new AdminResource(Admin::create([
                'name' => $credentials['name'],
                'email' => $credentials['email'],
                'gender' => $credentials['gender'],
                'phone_number' => $credentials['phone_number'],
                'address' => $credentials['address'],
                // 'password' =>  Hash::make($credentials['password']),
                'password' => $credentials['password'],
                'url_image' => $credentials['url_image'],
            ]));

            $token = $admin->createToken('AdminToken', ['admin'])->accessToken;
            // event(new Registered($admin));
            // $admin->SendEmailVerificationNotification();

            return $this->apiResponse($token, 'تم إنشاء حساب بنجاح', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // $email = Admin::where('email', $credentials['email'])->first();
        if (Auth::guard('admin')->attempt(['email' => $credentials['email'], 'password' =>  $credentials['password']])) {
            $client = Auth::guard('admin')->user();
            if ($client->email_verified_at == null) {
                return $this->apiResponse(null, 'يجب تفعيل حسابك', Response::HTTP_UNAUTHORIZED);
            }
            if ($client->status == 0) {
                return $this->apiResponse(null, 'تم ايقاف حسابك الرجاء التواصل مع الادارة ', Response::HTTP_UNAUTHORIZED);
            }
            config(['auth.guards.api.provider' => 'admin']);
            // $token = $client->createToken('AdminToken', ['admin_api'])->accessToken;
            $token = Auth::guard('admin')->user()->createToken('AdminToken', ['admin'])->accessToken;

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
        // $googleAdmin = Socialite::driver('google')->stateless()->redirect();
        // return dd( $googleAdmin);
        return  $googleUser = Socialite::driver('google')->stateless()->redirect();
        // return Socialite::driver('google')->redirect();
        // return dd(Socialite::driver('google')->user());
    }
    public function callback()
    {

        try {
            $googleAdmin = Socialite::driver('google')->stateless()->user();

            // Check for existing user or create a new one
            $existingAdmin = Admin::where('email', $googleAdmin->email)->first();

            if (!$existingAdmin) {
                $newAdmin = Admin::create([
                    'name' => $googleAdmin->name,
                    'email' => $googleAdmin->email,
                    'gender' => 1,
                    'phone_number' => '77',
                    'address' => 'add',
                    'password' => '123456',
                    'url_image' =>  $googleAdmin->avatar,
                    // 'email_verified_at' => now(),
                    // 'social_id' => $googleAdmin->id,
                    // 'social_type' =>  'google',
                ]);
                // Optionally store access token if needed
            }
            $token = $existingAdmin ? $existingAdmin->createToken('AdminToken', ['admin'])->accessToken : $newAdmin->createToken('AdminToken', ['admin'])->accessToken;

            // $token = $existingAdmin ?: $newAdmin->createToken('Personal Access Token')->accessToken;
            // Log in the user
            // Auth::login($existingAdmin ?: $newAdmin);
            Auth::guard('admin')->login($existingAdmin ?: $newAdmin);
            return $this->apiResponse($googleAdmin,  $token, Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'Authentication failed', Response::HTTP_INTERNAL_SERVER_ERROR);
        }


        // $googleAdmin = Socialite::driver('google')->stateless()->user();
        // return dd($googleAdmin);

        // $googleAdmin = Socialite::driver('google')->stateless()->user();
        // // $credentials = $request->only('name', 'email', 'gender', 'phone_number', 'address', 'password', 'url_image');
        // $admin = Admin::create([
        //     'name' => $googleAdmin->name,
        //     'email' => $googleAdmin->email,
        //     'gender' => 1,
        //     'phone_number' => '77',
        //     'address' => 'add',
        //     'password' => '123456',
        //     'url_image' =>  $googleAdmin->avatar,
        //     // 'email_verified_at' => now(),
        // ]);
        // dd($admin);
        // return Auth::guard('admin')->login($admin);


        // try {
        //     $googleAdmin = Socialite::driver('google')->stateless()->user();

        //     // Check for existing user or create a new one
        //     $existingAdmin = Admin::where('email', $googleAdmin->email)->first();

        //     if (!$existingAdmin) {
        //         $newAdmin = Admin::create([
        //             'name' => $googleAdmin->name,
        //             'email' => $googleAdmin->email,
        //             'gender' => $googleAdmin->user['gender'],
        //             'phone_number' => $googleAdmin->user['phone_number'],
        //             'address' => $googleAdmin->user['address'],
        //             'password' => '123456',
        //             'url_image' =>  $googleAdmin->avatar,
        //             'email_verified_at' => now(),
        //             'social_id' => $googleAdmin->id,
        //             'social_type' =>  'google',
        //         ]);
        //         // Optionally store access token if needed
        //     }
        //     $token = $existingUser ?: $newUser->createToken('Personal Access Token')->accessToken;
        //     // Log in the user
        //     // Auth::login($existingAdmin ?: $newAdmin);
        //     Auth::guard('admin')->login($existingAdmin ?: $newAdmin);
        //     // Return a success response or redirect
        //     // return response()->json([
        //     //     'message' => 'Login successful',
        //     //     'user' => $googleAdmin,
        //     // ], 200);
        //     return $this->apiResponse($googleAdmin, 'Login successful', Response::HTTP_OK);
        // } catch (\Exception $e) {
        //     // Handle authentication errors
        //     // return response()->json([
        //     //     'message' => 'Authentication failed',
        //     //     'error' => $e->getMessage(),
        //     // ], 401);
        //     return $this->apiResponse($e->getMessage(), 'Authentication failed', Response::HTTP_INTERNAL_SERVER_ERROR);
        // }
    }
    public function logout()
    {
        try {
            Auth::guard('admin')->logout();
            return $this->apiResponse(null, 'تم تسجيل الخروج بنجاح', Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'Authentication failed', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        // $token->revoke();

    }

    public function userInfo(Request $request)
    {
        $user = auth()->user();
        return $this->apiResponse($user, 'Token', Response::HTTP_OK);
    }

    public function ckeckStatus()
    {
        $status = Admin::where('id', auth('admin')->user()->id)->first()->status;
        if ($status == 0) {
            Auth::guard('admin')->logout();
        }
    }
}

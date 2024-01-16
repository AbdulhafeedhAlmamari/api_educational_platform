<?php

namespace App\Http\Traits;

use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\ForgotPasswordMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

trait ResetPasswordTrait
{

    use ApiResponseTrait;

    public function forgotPassword(Request $request, $tableReset, $model)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $user = $model::where('email', $request->email)->first();
        if (!$user) {
            return  $this->apiResponse(null, 'Invalid email', Response::HTTP_NOT_FOUND);
        }
        $token = Str::random(60);
        try {
            DB::table($tableReset)->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            Mail::to($user->email)->send(new ForgotPasswordMail($token));
            return  $this->apiResponse(null, 'We have e-mailed your password reset link!', Response::HTTP_OK);
        } catch (\Exception $e) {
            return  $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function resetPassword(ResetPasswordRequest $request, $token, $tableReset, $model)
    {

        if (!$resetPassword = DB::table($tableReset)->where('token', $token)->first()) {
            return  $this->apiResponse(null, 'Invalid token', Response::HTTP_NOT_FOUND);
        }
        if (!$user = $model::where('email', $resetPassword->email)->first()) {
            return  $this->apiResponse(null, 'Invalid token', Response::HTTP_NOT_FOUND);
        }
        $user->password = Hash::make($request->input('password'));
        $user->save();
        DB::table($tableReset)->where('email', $user->email)->delete();
        return $this->apiResponse(null, 'Password reset successfully', Response::HTTP_OK);
    }
}

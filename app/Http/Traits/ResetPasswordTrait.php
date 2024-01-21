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

    /**
     * Perform the forgot password functionality.
     *
     * @param Request $request the request object containing the email
     * @param string $tableReset the name of the table to reset the password
     * @param string $model the name of the model to retrieve the user
     * @throws \Exception if an error occurs during the process
     * @return \Illuminate\Http\Response the API response with the result
     */

    public function forgotPassword(Request $request, $tableReset, $model)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        if (DB::table($tableReset)->where('email', $request->email)->exists()) {
            return  $this->apiResponse(null, 'We have e-mailed your password reset link!', Response::HTTP_OK);
        }
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
            $urlToken = 'api/' . substr($tableName = $user->getTable(), 0, -1) . '/reset-password/' . $token;
            Mail::to($user->email)->send(new ForgotPasswordMail($urlToken));
            return  $this->apiResponse(null, 'We have e-mailed your password reset link!', Response::HTTP_OK);
        } catch (\Exception $e) {
            return  $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Reset the password for a user.
     *
     * @param ResetPasswordRequest $request The request object containing the password reset data.
     * @param mixed $token The token used to identify the password reset.
     * @param string $tableReset The name of the table used to store password reset information.
     * @param string $model The name of the model used to retrieve user data.
     * @return ApiResponse|null The API response indicating the status of the password reset.
     *
     * @throws \Exception If an error occurs during the password reset process.
     */

    public function resetPassword($request, $token, $tableReset, $model)
    {
        try {
            if (!$resetPassword = DB::table($tableReset)->where('token', $token)->first()) {
                return  $this->apiResponse(null, 'Invalid token', Response::HTTP_NOT_FOUND);
            }
            if (!$user = $model::where('email', $resetPassword->email)->first()) {
                return  $this->apiResponse(null, 'user not found', Response::HTTP_NOT_FOUND);
            }

            $user->password = Hash::make($request->input('password'));
            $user->save();
            DB::table($tableReset)->where('email', $user->email)->delete();
            return $this->apiResponse(null, 'Password reset successfully', Response::HTTP_OK);
        } catch (\Exception $e) {
            return  $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

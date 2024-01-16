<?php

namespace App\Http\Traits;

use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Requests\ResetPasswordRequest;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

trait ResetPasswordTrait
{

    use ApiResponseTrait;

    public function resetPassword(ResetPasswordRequest $request, $token, $tableReset, $tableUser)
    {

        if (!$resetPassword = DB::table($tableReset)->where('token', $token)->first()) {
            return  $this->apiResponse(null, 'Invalid token', Response::HTTP_NOT_FOUND);
        }
        if (!$user = $tableUser::where('email', $resetPassword->email)->first()) {
            return  $this->apiResponse(null, 'Invalid token', Response::HTTP_NOT_FOUND);
        }
        $user->password = Hash::make($request->input('password'));
        $user->save();
        DB::table($tableReset)->where('email', $user->email)->delete();
        return $this->apiResponse(null, 'Password reset successfully', Response::HTTP_OK);
    }
}

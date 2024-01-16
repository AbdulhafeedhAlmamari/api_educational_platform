<?php

namespace App\Http\Controllers\Api\v1\auth;

use App\Http\Controllers\Api\ApiResponseTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Traits\ResetPasswordTrait;
use App\Mail\ForgotPasswordMail;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Symfony\Component\HttpFoundation\Response;

class NewPasswordController extends Controller
{

    use  Notifiable;
    use ResetPasswordTrait;
    use ApiResponseTrait;
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $email = $request->input('email');
        $user = null;

        if (Student::where('email', $email)->exists()) {
            $user = Student::where('email', $email)->first();
        } elseif (Teacher::where('email', $email)->exists()) {
            $user = Teacher::where('email', $email)->first();
        } elseif (Admin::where('email', $email)->exists()) {
            $user = Admin::where('email', $email)->first();
        } else {
            return $this->apiResponse(null, 'User not found', Response::HTTP_NOT_FOUND);
        }

        $token = Str::random(60);

        try {
            $tableName = $user->getTable(); //   اسم الجدول الخاص بالمستخدم
            $dateTime = Carbon::now()->format('Y-m-d H:i:s');
            DB::table(substr($tableName, 0, -1) . '_password_reset_tokens')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' =>  $dateTime,
            ]);

            Mail::to($user->email)->send(new ForgotPasswordMail($token));
            return  $this->apiResponse(null, 'Check your email', Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function reset(ResetPasswordRequest $request, $token)
    {

        // $token =   $request->input('token');
        if (!$resetPassword = DB::table('student_password_reset_tokens')->where('token', $token)->first()) {
            return   $this->apiResponse(null, 'Invalid token', Response::HTTP_NOT_FOUND);
        }
        if (!$user = Student::where('email', $resetPassword->email)->first()) {
            return   $this->apiResponse(null, 'User not found', Response::HTTP_NOT_FOUND);
        }
        $user->password = Hash::make($request->input('password'));
        $user->save();
        DB::table('student_password_reset_tokens')->where('email', $user->email)->delete();
        return  $this->apiResponse(null, 'Password reset successfully', Response::HTTP_OK);
    }
}

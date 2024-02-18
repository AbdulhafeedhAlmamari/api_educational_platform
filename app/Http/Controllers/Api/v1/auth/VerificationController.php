<?php

namespace App\Http\Controllers\Api\v1\auth;

use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificationController extends Controller
{

    use ApiResponseTrait;
    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function verify(EmailVerificationRequest $request) //: RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {

            return $this->apiResponse(null, 'تم التحقق من بريدك الالكتروني بالفعل', Response::HTTP_OK);
        }
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }
        return $this->apiResponse(null, '  تم التحقق من بريدك الالكتروني', Response::HTTP_OK);
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function resend(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $user = Student::where('email', $request->email)->first();
        if ($user) {
            if ($user->hasVerifiedEmail()) {
                return $this->apiResponse(null, 'تم التحقق من بريدك الالكتروني بالفعل', Response::HTTP_OK);
            }
            $user->sendEmailVerificationNotification();
            return $this->apiResponse(null, 'تم ارسال التحقق البريد الالكتروني بنجاح', Response::HTTP_OK);
        }
        return $this->apiResponse(null, 'البريد الالكتروني غير موجود', Response::HTTP_NOT_FOUND);
    }
}

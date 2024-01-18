<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{

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
            // return redirect(env('/') . '/email/verify/already-success');
            return response()->json(['message' => 'Email already verified']);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }
        // return redirect(env('https') . '/email/verify/success');
        return  response()->json(['message' => 'Email verified']);
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
        if ($request->user()->hasVerifiedEmail()) {

            return response(['message' => 'Already verified']);
        }

        $request->user()->sendEmailVerificationNotification();

        if ($request->wantsJson()) {
            return response(['message' => 'Email Sent']);
        }

        return back()->with('resent', true);
    }
}

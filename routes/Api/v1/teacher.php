<?php

use App\Http\Controllers\Api\v1\auth\Teacher\TeacherAuthController;
use App\Http\Controllers\Api\v1\TeacherController;
use Illuminate\Support\Facades\Route;

Route::post('teacher/register', [TeacherAuthController::class, 'register']);

Route::post('teacher/login', [TeacherAuthController::class, 'login']);

Route::get('auth/google/redirect', [TeacherAuthController::class, 'redirect']);
Route::get('auth/google/callback', [TeacherAuthController::class, 'callback']);
// 'prefix' => 'teacher',
Route::group(['middleware' => ['auth:teacher_api', 'scopes:teacher']], function () {
    Route::get('student/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::get('student/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    // Route::resource('teacher', StudentController::class);
    Route::get('teacher/logout', [StudentAuthController::class, 'logout']);
    Route::post('teacher/forgot-password', [ResetPasswordController::class, 'sendResetLinkEmail']);//->name('password.email');
    Route::post('teacher/reset-password/{token}', [ResetPasswordController::class, 'reset']);

    Route::get('teachers', [TeacherController::class, 'index']);
    Route::get('teacher/{id}', [TeachersController::class, 'show']);
    Route::post('teacher/store', [TeachersController::class, 'store']);
    Route::post('teacher/update/{id}', [TeachersController::class, 'update']);
    Route::post('teacher/destroy/{id}', [TeachersController::class, 'destroy']);
});

<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\v1\auth\Admin\AdminAuthController;
use Illuminate\Support\Facades\Route;

Route::post('admin/register', [AdminAuthController::class, 'register']);

Route::post('admin/login', [AdminAuthController::class, 'login']);

Route::get('auth/google/redirect', [AdminAuthController::class, 'redirect']);
Route::get('auth/google/callback', [AdminAuthController::class, 'callback']);
// 'prefix' => 'admin',
Route::group(['middleware' => ['auth:admin_api', 'scopes:admin']], function () {
    Route::get('student/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::get('student/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    // Route::resource('teacher', StudentController::class);
    Route::get('teacher/logout', [StudentAuthController::class, 'logout']);
    Route::post('admin/forgot-password', [ResetPasswordController::class, 'sendResetLinkEmail']);//->name('password.email');;
    Route::post('admin/reset-password/{token}', [ResetPasswordController::class, 'reset']);

    Route::get('admins', [AdminController::class, 'index']);
    Route::get('admin/{id}', [AdminController::class, 'show']);
    Route::post('admin/store', [AdminController::class, 'store']);
    Route::post('admin/update/{id}', [AdminController::class, 'update']);
    Route::post('admin/destroy/{id}', [AdminController::class, 'destroy']);
});

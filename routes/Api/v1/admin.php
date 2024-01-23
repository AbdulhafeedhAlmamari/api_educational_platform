<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\v1\auth\Admin\AdminAuthController;
use App\Http\Controllers\Api\v1\auth\Admin\ResetPasswordController;
use App\Http\Controllers\Api\v1\auth\VerificationController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\CourseController;
use App\Http\Controllers\Api\v1\LessoneController;
use App\Http\Controllers\Api\v1\SectionController;
use Illuminate\Support\Facades\Route;

Route::post('admin/register', [AdminAuthController::class, 'register']);

Route::post('admin/login', [AdminAuthController::class, 'login']);

Route::get('auth/google/redirect', [AdminAuthController::class, 'redirect']);
Route::get('auth/google/callback', [AdminAuthController::class, 'callback']);
// 'prefix' => 'admin',
Route::group(['middleware' => ['auth:admin_api', 'scopes:admin']], function () {
    Route::get('admin/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('admin.verification.verify');
    Route::get('admin/email/resend', [VerificationController::class, 'resend'])->name('admin.verification.resend');
    // Route::resource('teacher', StudentController::class);
    Route::get('admin/logout', [AdminAuthController::class, 'logout']);
    Route::post('admin/forgot-password', [ResetPasswordController::class, 'sendResetLinkEmail']); //->name('password.email');;
    Route::post('admin/reset-password/{token}', [ResetPasswordController::class, 'reset']);

    Route::get('admins', [AdminController::class, 'index']);
    Route::get('admin/{id}', [AdminController::class, 'show']);
    Route::post('admin/store', [AdminController::class, 'store']);
    Route::post('admin/update/{id}', [AdminController::class, 'update']);
    Route::post('admin/destroy/{id}', [AdminController::class, 'destroy']);

    Route::controller(CourseController::class)->group(function () {
        Route::post('courses/store', 'store');
        Route::post('courses/update/{id}', 'update');
        Route::post('courses/destroy/{id}', 'destroy');
    });

    Route::controller(SectionController::class)->group(function () {
        Route::post('sections/store', 'store');
        Route::post('sections/update/{id}', 'update');
        Route::post('sections/destroy/{id}', 'destroy');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::post('categories/store', 'store');
        Route::post('categories/update/{id}', 'update');
        Route::post('categories/destroy/{id}', 'destroy');
    });
    Route::controller(LessoneController::class)->group(function () {
        Route::post('lessones/store', 'store');
        Route::post('lessones/update/{id}', 'update');
        Route::post('lessones/destroy/{id}', 'destroy');
    });
});

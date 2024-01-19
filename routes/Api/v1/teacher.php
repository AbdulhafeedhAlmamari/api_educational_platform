<?php


use App\Http\Controllers\Api\PassportAuthController;
use App\Http\Controllers\Api\v1\Auth\Student\StudentAuthController;
use Illuminate\Support\Facades\Route;


// Route::middleware(['auth:api'])->group(function (){

// });

// Route::resource('courses', CourseController::class);

// Route::get('lang/{lang}', [LangControllerroller::class, 'change']);

Route::post('student/register', [StudentAuthController::class, 'register']);
Route::post('student/login', [StudentAuthController::class, 'login']); //->name('userLogin');

// Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']); //->name('userLogin');
Route::group(['prefix' => 'user', 'middleware' => ['auth:user_api', 'scopes:user_api']], function () {
    // authenticated staff routes here
    // Route::get('courses', [CourseController::class, 'index']);
});

// Route::post('login', [PassportAuthController::class, 'login']);


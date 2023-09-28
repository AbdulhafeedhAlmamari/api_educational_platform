<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\PassportAuthController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\TeachersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware(['auth:api'])->group(function (){

// });

// Route::resource('courses', CourseController::class);

Route::get('lang/{lang}', [LangControllerroller::class, 'change']);

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']); //->name('userLogin');
Route::group(['prefix' => 'user', 'middleware' => ['auth:user_api', 'scopes:user_api']], function () {
    // authenticated staff routes here 
    Route::get('courses', [CourseController::class, 'index']);
});

// Route::post('login', [PassportAuthController::class, 'login']);



// Route::get('courses', [CourseController::class, 'index'])->middleware('auth:api');
Route::get('courses/{id}', [CourseController::class, 'show']);
Route::post('store', [CourseController::class, 'store']);
Route::post('update/{id}', [CourseController::class, 'update']);
Route::post('destroy/{id}', [CourseController::class, 'destroy']);

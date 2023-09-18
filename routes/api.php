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


Route::post('register', [PassportAuthController::class, 'register']);
Route::get('login', [PassportAuthController::class, 'login']);

Route::get('lang/{lang}', [LangControllerroller::class, 'change']);


Route::get('courses', [CourseController::class, 'index']);
Route::get('courses/{id}', [CourseController::class, 'show']);
Route::post('store', [CourseController::class, 'store']);
Route::post('update/{id}', [CourseController::class, 'update']);
Route::post('destroy/{id}', [CourseController::class, 'destroy']);
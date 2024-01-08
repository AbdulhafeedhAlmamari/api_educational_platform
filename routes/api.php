<?php

use App\Http\Controllers\Api\v1\CourseController;
use App\Http\Controllers\Api\PassportAuthController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\Api\v1\StudentController;
use App\Http\Controllers\Api\v1\SectionController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\v1\LessoneController;
use App\Http\Controllers\Api\v1\FavoriteController;
use App\Http\Controllers\Api\v1\RecorderController;

use App\Http\Controllers\Api\v1\TeacherController;
use App\Http\Controllers\Api\v1\auth\StudentAuthController;
use App\Http\Controllers\Api\v1\RatingsCourseController;
use App\Http\Controllers\Api\v1\RatingsSiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware(['auth:api'])->group(function (){

// });

// Route::resource('courses', CourseController::class);

// Route::get('lang/{lang}', [LangControllerroller::class, 'change']);

Route::post('student/register', [StudentAuthController::class, 'register']);


Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']); //->name('userLogin');
Route::group(['prefix' => 'user', 'middleware' => ['auth:user_api', 'scopes:user_api']], function () {
    // authenticated staff routes here
    Route::get('courses', [CourseController::class, 'index']);
});


Route::resource('courses',CourseController::class);
Route::resource('students',StudentController::class);
Route::resource('teachers',TeacherController::class);
Route::resource('sections',SectionController::class);
Route::resource('categories',CategoryController::class);
Route::resource('lessones',LessoneController::class);
Route::resource('favorites',FavoriteController::class);
Route::resource('records',RecorderController::class);
Route::resource('ratingsCourse',RatingsCourseController::class);
Route::resource('ratingsSite',RatingsSiteController::class);


Route::get('admin', [AdminController::class , 'index']);
Route::get('admin/{id}', [AdminController::class , 'show']);
Route::post('admin/store', [AdminController::class , 'store']);
Route::post('admin/update/{id}', [AdminController::class , 'update']);
Route::post('admin/destroy/{id}', [AdminController::class , 'destroy']);




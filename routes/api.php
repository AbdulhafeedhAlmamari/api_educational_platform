<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\PassportAuthController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeachersController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\LessoneController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\RecorderController;
use App\Http\Controllers\Api\RatingsCourseController;
use App\Http\Controllers\Api\RatingsSiteController;
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

Route::get('courses/{id}', [CourseController::class, 'show']);
Route::post('store', [CourseController::class, 'store']);
Route::post('update/{id}', [CourseController::class, 'update']);
Route::post('destroy/{id}', [CourseController::class, 'destroy']);
Route::post('courses/store', [CourseController::class, 'store']);
Route::post('courses/update/{id}', [CourseController::class, 'update']);
Route::post('courses/destroy/{id}', [CourseController::class, 'destroy']);

Route::get('students', [StudentController::class , 'index']);
Route::get('students/{id}', [StudentController::class , 'show']);
Route::post('students/store', [StudentController::class , 'store']);
Route::post('students/update/{id}', [StudentController::class , 'update']);
Route::post('students/destroy/{id}', [StudentController::class , 'destroy']);

Route::get('teachers', [TeachersController::class , 'index']);
Route::get('teachers/{id}', [TeachersController::class , 'show']);
Route::post('teachers/store', [TeachersController::class , 'store']);
Route::post('teachers/update/{id}', [TeachersController::class , 'update']);
Route::post('teachers/destroy/{id}', [TeachersController::class , 'destroy']);

Route::get('section', [SectionController::class , 'index']);
Route::get('section/{id}', [SectionController::class , 'show']);
Route::post('section/store', [SectionController::class , 'store']);
Route::post('section/update/{id}', [SectionController::class , 'update']);
Route::post('section/destroy/{id}', [SectionController::class , 'destroy']);

Route::get('category', [CategoryController::class , 'index']);
Route::get('category/{id}', [CategoryController::class , 'show']);
Route::post('category/store', [CategoryController::class , 'store']);
Route::post('category/update/{id}', [CategoryController::class , 'update']);
Route::post('category/destroy/{id}', [CategoryController::class , 'destroy']);

Route::get('admin', [AdminController::class , 'index']);
Route::get('admin/{id}', [AdminController::class , 'show']);
Route::post('admin/store', [AdminController::class , 'store']);
Route::post('admin/update/{id}', [AdminController::class , 'update']);
Route::post('admin/destroy/{id}', [AdminController::class , 'destroy']);

Route::get('lessone', [LessoneController::class , 'index']);
Route::get('lessone/{id}', [LessoneController::class , 'show']);
Route::post('lessone/store', [LessoneController::class , 'store']);
Route::post('lessone/update/{id}', [LessoneController::class , 'update']);
Route::post('lessone/destroy/{id}', [LessoneController::class , 'destroy']);

Route::get('favorite', [FavoriteController::class , 'index']);
Route::get('favorite/{id}', [FavoriteController::class , 'show']);
Route::post('favorite/store', [FavoriteController::class , 'store']);
Route::post('favorite/update/{id}', [FavoriteController::class , 'update']);
Route::post('favorite/destroy/{id}', [FavoriteController::class , 'destroy']);

Route::get('recorder', [RecorderController::class , 'index']);
Route::get('recorder/{id}', [RecorderController::class , 'show']);
Route::post('recorder/store', [RecorderController::class , 'store']);
Route::post('recorder/update/{id}', [RecorderController::class , 'update']);
Route::post('recorder/destroy/{id}', [RecorderController::class , 'destroy']);

Route::get('ratingsCourse', [RatingsCourseController::class , 'index']);
Route::get('ratingsCourse/{id}', [RatingsCourseController::class , 'show']);
Route::post('ratingsCourse/store', [RatingsCourseController::class , 'store']);
Route::post('ratingsCourse/update/{id}', [RatingsCourseController::class , 'update']);
Route::post('ratingsCourse/destroy/{id}', [RatingsCourseController::class , 'destroy']);

Route::get('ratingsSite', [RatingsSiteController::class , 'index']);
Route::get('ratingsSite/{id}', [RatingsSiteController::class , 'show']);
Route::post('ratingsSite/store', [RatingsSiteController::class , 'store']);
Route::post('ratingsSite/update/{id}', [RatingsSiteController::class , 'update']);
Route::post('ratingsSite/destroy/{id}', [RatingsSiteController::class , 'destroy']);



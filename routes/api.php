<?php

use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\CourseController;
use App\Http\Controllers\Api\v1\FavoriteController;
use App\Http\Controllers\Api\v1\LessoneController;
use App\Http\Controllers\Api\v1\RatingsCourseController;
use App\Http\Controllers\Api\v1\RatingsSiteController;
use App\Http\Controllers\Api\v1\RecorderController;
use App\Http\Controllers\Api\v1\SectionController;
use Illuminate\Support\Facades\Route;


// Route::get('lang/{lang}', [LangControllerroller::class, 'change']);
    // authenticated staff routes here
// // Route::post('login', [PassportAuthController::class, 'login']);
Route::controller(CourseController::class)->group(function () {
    Route::get('courses', 'index');
    Route::get('courses/{id}', 'show');
});
Route::controller(SectionController::class)->group(function () {
    Route::get('sections', 'index');
    Route::get('section/{id}', 'show');
});
Route::controller(CategoryController::class)->group(function () {
    Route::get('categories', 'index');
    Route::get('category/{id}', 'show');
});
Route::controller(LessoneController::class)->group(function () {
    Route::get('lessones', 'index');
    Route::get('lessone/{id}', 'show');
});

Route::resource('ratingsCourse',RatingsCourseController::class);
Route::resource('ratingsSite',RatingsSiteController::class);

// Route::controller(FavoriteController::class)->group(function () {
//     Route::get('favorites');
//     Route::get('favorite/{id}', 'show');
// });
// Route::controller(RecorderController::class)->group(function () {
//     Route::get('records');
//     Route::get('record/{id}', 'show');
// });
// Route::controller(RatingsCourseController::class)->group(function () {
//     Route::get('ratingsCourse');
//     Route::get('ratingCourse/{id}', 'show');
// });
// Route::controller(RatingsSiteController::class)->group(function () {
//     Route::get('ratingsSite');
//     Route::get('ratingSite/{id}', 'show');
// });



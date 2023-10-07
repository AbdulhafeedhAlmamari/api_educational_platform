<?php
use App\Http\Controllers\Api\RatingsCourseController;
use Illuminate\Support\Facades\Route;

Route::get('ratingsCourse', [RatingsCourseController::class , 'index']);
Route::get('ratingsCourse/{id}', [RatingsCourseController::class , 'show']);
Route::post('ratingsCourse/store', [RatingsCourseController::class , 'store']);
Route::post('ratingsCourse/update/{id}', [RatingsCourseController::class , 'update']);
Route::post('ratingsCourse/destroy/{id}', [RatingsCourseController::class , 'destroy']);

?>

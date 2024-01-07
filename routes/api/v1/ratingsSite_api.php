<?php
// use App\Http\Controllers\Api\RatingsSiteController;
use App\Http\Controllers\Api\v1\RatingsSiteController;
use Illuminate\Support\Facades\Route;

Route::get('ratingsSite', [RatingsSiteController::class , 'index']);
Route::get('ratingsSite/{id}', [RatingsSiteController::class , 'show']);
Route::post('ratingsSite/store', [RatingsSiteController::class , 'store']);
Route::post('ratingsSite/update/{id}', [RatingsSiteController::class , 'update']);
Route::post('ratingsSite/destroy/{id}', [RatingsSiteController::class , 'destroy']);


?>

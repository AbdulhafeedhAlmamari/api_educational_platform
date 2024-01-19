<?php
// use App\Http\Controllers\Api\RatingsSiteController;
use App\Http\Controllers\Api\v1\RatingsSiteController;
use Illuminate\Support\Facades\Route;

Route::resource('ratingsSite',RatingsSiteController::class);


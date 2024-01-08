<?php
use App\Http\Controllers\Api\v1\RatingsCourseController;
use Illuminate\Support\Facades\Route;
Route::resource('ratingsCourse',RatingsCourseController::class);

?>

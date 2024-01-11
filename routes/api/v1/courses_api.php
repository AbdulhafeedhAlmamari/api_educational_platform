<?php
use App\Http\Controllers\Api\v1\CourseController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user', 'middleware' => ['auth:user_api', 'scopes:user_api']], function () {
    // authenticated staff routes here
    // Route::get('courses', [CourseController::class, 'index']);
});

Route::resource('courses',CourseController::class);
?>


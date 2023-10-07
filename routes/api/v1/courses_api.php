<?php
use App\Http\Controllers\Api\CourseController;
use Illuminate\Support\Facades\Route;

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

?>


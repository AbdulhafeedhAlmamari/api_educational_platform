<!-- <?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\PassportAuthController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeachersController;
use App\Http\Controllers\Api\CategoryMainController;
use App\Http\Controllers\Api\CategorySubController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\LessoneController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\RecorderController;
use App\Http\Controllers\Api\CommentsCourseController;
use App\Http\Controllers\Api\CommentsSiteController;
use App\Http\Controllers\Api\v1\auth\StudentAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('student/register', [StudentAuthController::class, 'register']);
Route::post('student/login', [StudentAuthController::class, 'login']); //->name('userLogin');

// Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']); //->name('userLogin');
Route::group(['prefix' => 'user', 'middleware' => ['auth:user_api', 'scopes:user_api']], function () {
    // authenticated staff routes here
    // Route::get('courses', [CourseController::class, 'index']);
});

// Route::post('login', [PassportAuthController::class, 'login']);



// Route::get('courses', [CourseController::class, 'index'])->middleware('auth:api');


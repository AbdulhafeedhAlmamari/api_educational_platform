<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\PassportAuthController;
use App\Http\Controllers\Api\v1\Auth\VerificationController;
use App\Http\Controllers\Api\v1\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware(['auth:api'])->group(function (){

// });

// Route::resource('courses', CourseController::class);

// Route::get('lang/{lang}', [LangControllerroller::class, 'change']);

// Route::post('student/register', [StudentAuthController::class, 'register']);
// Route::post('student/login', [StudentAuthController::class, 'login']); //->name('userLogin');

// Route::post('register', [PassportAuthController::class, 'register']);
// Route::post('login', [PassportAuthController::class, 'login']); //->name('userLogin');
// Route::group(['prefix' => 'user', 'middleware' => ['auth:user', 'scopes:user']], function () {



    // authenticated staff routes here
    // Route::get('courses', [CourseController::class, 'index']);
// });

// // Route::post('login', [PassportAuthController::class, 'login']);

// Route::resource('courses',CourseController::class);
// Route::resource('students',StudentController::class);
// Route::resource('teachers',TeacherController::class);
// Route::resource('sections',SectionController::class);
// Route::resource('categories',CategoryController::class);
// Route::resource('lessones',LessoneController::class);
// Route::resource('favorites',FavoriteController::class);
// Route::resource('records',RecorderController::class);
// Route::resource('ratingsCourse',RatingsCourseController::class);
// Route::resource('ratingsSite',RatingsSiteController::class);


// // Route::get('courses', [CourseController::class, 'index'])->middleware('auth:api');
// Route::get('courses/{id}', [CourseController::class, 'show']);
// Route::post('store', [CourseController::class, 'store']);
// Route::post('update/{id}', [CourseController::class, 'update']);
// Route::post('destroy/{id}', [CourseController::class, 'destroy']);
// Route::post('courses/store', [CourseController::class, 'store']);
// Route::post('courses/update/{id}', [CourseController::class, 'update']);
// Route::post('courses/destroy/{id}', [CourseController::class, 'destroy']);

// Route::get('students', [StudentController::class, 'index']);
// Route::get('students/{id}', [StudentController::class, 'show']);
// Route::post('students/store', [StudentController::class, 'store']);
// Route::post('students/update/{id}', [StudentController::class, 'update']);
// Route::post('students/destroy/{id}', [StudentController::class, 'destroy']);

// Route::get('teachers', [TeachersController::class, 'index']);
// Route::get('teachers/{id}', [TeachersController::class, 'show']);
// Route::post('teachers/store', [TeachersController::class, 'store']);
// Route::post('teachers/update/{id}', [TeachersController::class, 'update']);
// Route::post('teachers/destroy/{id}', [TeachersController::class, 'destroy']);

// Route::get('categoryMain', [CategoryMainController::class, 'index']);
// Route::get('categoryMain/{id}', [CategoryMainController::class, 'show']);
// Route::post('categoryMain/store', [CategoryMainController::class, 'store']);
// Route::post('categoryMain/update/{id}', [CategoryMainController::class, 'update']);
// Route::post('categoryMain/destroy/{id}', [CategoryMainController::class, 'destroy']);

// Route::get('categorySub', [CategorySubController::class, 'index']);
// Route::get('categorySub/{id}', [CategorySubController::class, 'show']);
// Route::post('categorySub/store', [CategorySubController::class, 'store']);
// Route::post('categorySub/update/{id}', [CategorySubController::class, 'update']);
// Route::post('categorySub/destroy/{id}', [CategorySubController::class, 'destroy']);

// Route::get('admin', [AdminController::class, 'index']);
// Route::get('admin/{id}', [AdminController::class, 'show']);
// Route::post('admin/store', [AdminController::class, 'store']);
// Route::post('admin/update/{id}', [AdminController::class, 'update']);
// Route::post('admin/destroy/{id}', [AdminController::class, 'destroy']);

// Route::get('lessone', [LessoneController::class, 'index']);
// Route::get('lessone/{id}', [LessoneController::class, 'show']);
// Route::post('lessone/store', [LessoneController::class, 'store']);
// Route::post('lessone/update/{id}', [LessoneController::class, 'update']);
// Route::post('lessone/destroy/{id}', [LessoneController::class, 'destroy']);

// Route::get('favorite', [FavoriteController::class, 'index']);
// Route::get('favorite/{id}', [FavoriteController::class, 'show']);
// Route::post('favorite/store', [FavoriteController::class, 'store']);
// Route::post('favorite/update/{id}', [FavoriteController::class, 'update']);
// Route::post('favorite/destroy/{id}', [FavoriteController::class, 'destroy']);

// Route::get('recorder', [RecorderController::class, 'index']);
// Route::get('recorder/{id}', [RecorderController::class, 'show']);
// Route::post('recorder/store', [RecorderController::class, 'store']);
// Route::post('recorder/update/{id}', [RecorderController::class, 'update']);
// Route::post('recorder/destroy/{id}', [RecorderController::class, 'destroy']);

// Route::get('commentsCourse', [CommentsCourseController::class, 'index']);
// Route::get('commentsCourse/{id}', [CommentsCourseController::class, 'show']);
// Route::post('commentsCourse/store', [CommentsCourseController::class, 'store']);
// Route::post('commentsCourse/update/{id}', [CommentsCourseController::class, 'update']);
// Route::post('commentsCourse/destroy/{id}', [CommentsCourseController::class, 'destroy']);

// Route::get('commentsSite', [CommentsSiteController::class, 'index']);
// Route::get('commentsSite/{id}', [CommentsSiteController::class, 'show']);
// Route::post('commentsSite/store', [CommentsSiteController::class, 'store']);
// Route::post('commentsSite/update/{id}', [CommentsSiteController::class, 'update']);
// Route::post('commentsSite/destroy/{id}', [CommentsSiteController::class, 'destroy']); 

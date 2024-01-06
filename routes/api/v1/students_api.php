<?php

use App\Http\Controllers\Api\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('students', [StudentController::class , 'index']);
Route::get('students/{id}', [StudentController::class , 'show']);
Route::post('students/store', [StudentController::class , 'store']);
Route::post('students/update/{id}', [StudentController::class , 'update']);
Route::post('students/destroy/{id}', [StudentController::class , 'destroy']);

?>

<?php
use App\Http\Controllers\Api\TeachersController;
use Illuminate\Support\Facades\Route;

Route::get('teachers', [TeachersController::class , 'index']);
Route::get('teachers/{id}', [TeachersController::class , 'show']);
Route::post('teachers/store', [TeachersController::class , 'store']);
Route::post('teachers/update/{id}', [TeachersController::class , 'update']);
Route::post('teachers/destroy/{id}', [TeachersController::class , 'destroy']);

?>

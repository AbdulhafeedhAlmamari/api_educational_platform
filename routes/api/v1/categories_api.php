<?php
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('category', [CategoryController::class , 'index']);
Route::get('category/{id}', [CategoryController::class , 'show']);
Route::post('category/store', [CategoryController::class , 'store']);
Route::post('category/update/{id}', [CategoryController::class , 'update']);
Route::post('category/destroy/{id}', [CategoryController::class , 'destroy']);


?>

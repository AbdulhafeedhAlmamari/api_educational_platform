<?php
use App\Http\Controllers\Api\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('admin', [AdminController::class , 'index']);
Route::get('admin/{id}', [AdminController::class , 'show']);
Route::post('admin/store', [AdminController::class , 'store']);
Route::post('admin/update/{id}', [AdminController::class , 'update']);
Route::post('admin/destroy/{id}', [AdminController::class , 'destroy']);

?>

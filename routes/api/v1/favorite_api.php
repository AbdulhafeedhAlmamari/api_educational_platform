<?php
use App\Http\Controllers\Api\FavoriteController;
use Illuminate\Support\Facades\Route;

Route::get('favorite', [FavoriteController::class , 'index']);
Route::get('favorite/{id}', [FavoriteController::class , 'show']);
Route::post('favorite/store', [FavoriteController::class , 'store']);
Route::post('favorite/update/{id}', [FavoriteController::class , 'update']);
Route::post('favorite/destroy/{id}', [FavoriteController::class , 'destroy']);

?>

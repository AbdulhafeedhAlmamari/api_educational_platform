<?php
use App\Http\Controllers\Api\RecorderController;
use Illuminate\Support\Facades\Route;

Route::get('recorder', [RecorderController::class , 'index']);
Route::get('recorder/{id}', [RecorderController::class , 'show']);
Route::post('recorder/store', [RecorderController::class , 'store']);
Route::post('recorder/update/{id}', [RecorderController::class , 'update']);
Route::post('recorder/destroy/{id}', [RecorderController::class , 'destroy']);

?>

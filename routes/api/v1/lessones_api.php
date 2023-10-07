<?php
use App\Http\Controllers\Api\LessoneController;
use Illuminate\Support\Facades\Route;
Route::get('lessone', [LessoneController::class , 'index']);
Route::get('lessone/{id}', [LessoneController::class , 'show']);
Route::post('lessone/store', [LessoneController::class , 'store']);
Route::post('lessone/update/{id}', [LessoneController::class , 'update']);
Route::post('lessone/destroy/{id}', [LessoneController::class , 'destroy']);

?>

<?php
use App\Http\Controllers\Api\SectionController;
use Illuminate\Support\Facades\Route;

Route::get('section', [SectionController::class , 'index']);
Route::get('section/{id}', [SectionController::class , 'show']);
Route::post('section/store', [SectionController::class , 'store']);
Route::post('section/update/{id}', [SectionController::class , 'update']);
Route::post('section/destroy/{id}', [SectionController::class , 'destroy']);

?>

<?php
use App\Http\Controllers\Api\v1\FavoriteController;
use Illuminate\Support\Facades\Route;

Route::resource('favorites',FavoriteController::class);


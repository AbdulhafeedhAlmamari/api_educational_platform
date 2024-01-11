<?php
use App\Http\Controllers\Api\v1\CategoryController;
use Illuminate\Support\Facades\Route;

Route::resource('categories',CategoryController::class);


?>

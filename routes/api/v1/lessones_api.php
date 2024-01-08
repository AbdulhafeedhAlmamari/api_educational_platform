<?php
use App\Http\Controllers\Api\v1\LessoneController;
use Illuminate\Support\Facades\Route;

Route::resource('lessones',LessoneController::class);

?>

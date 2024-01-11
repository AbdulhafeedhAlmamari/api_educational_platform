<?php
use App\Http\Controllers\Api\v1\RecorderController;
use Illuminate\Support\Facades\Route;

Route::resource('records',RecorderController::class);

?>

<?php
use App\Http\Controllers\Api\v1\TeacherController;
use Illuminate\Support\Facades\Route;

Route::resource('teachers',TeacherController::class);


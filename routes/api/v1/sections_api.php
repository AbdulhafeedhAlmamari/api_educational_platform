<?php
use App\Http\Controllers\Api\v1\SectionController;
use Illuminate\Support\Facades\Route;

Route::resource('sections',SectionController::class);

?>

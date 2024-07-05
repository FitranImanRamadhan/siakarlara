<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('positions', App\Http\Controllers\PositionController::class, []);
    
});

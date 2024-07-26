<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('gajis', App\Http\Controllers\GajiController::class, []);
    
});

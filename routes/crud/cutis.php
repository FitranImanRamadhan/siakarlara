<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('cutis', App\Http\Controllers\CutiController::class, []);
    
});

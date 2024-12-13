<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('promos', App\Http\Controllers\PromoController::class, []);
    
});

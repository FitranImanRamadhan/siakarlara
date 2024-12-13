<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('galeris', App\Http\Controllers\GaleriController::class, []);
    
});

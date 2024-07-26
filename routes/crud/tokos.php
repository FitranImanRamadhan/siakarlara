<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('tokos', App\Http\Controllers\TokoController::class, []);
    
});

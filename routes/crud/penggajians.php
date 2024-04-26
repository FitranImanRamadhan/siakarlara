<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('penggajians', App\Http\Controllers\PenggajianController::class, []);
    
});

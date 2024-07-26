<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('pegawais', App\Http\Controllers\PegawaiController::class, []);
    
});

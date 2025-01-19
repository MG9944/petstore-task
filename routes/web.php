<?php

use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

Route::controller(PetController::class)->group(function () {
    Route::get('/', 'index');
    Route::prefix('pet')->group(function () {
        Route::get('/get', 'get');
        Route::post('/create', 'create');
        Route::put('/update', 'edit');
        Route::post('/uploadImage', 'uploadImage');
        Route::delete('/delete', 'delete');
    });
});

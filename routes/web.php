<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('juego');
});

// Agrega esta línea:
Route::post('/login-check', [AuthController::class, 'login']);
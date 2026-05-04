<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('juego');
});

Route::post('/login-check', [AuthController::class, 'login']);

Route::get('/admin',              [AdminController::class, 'index']);
Route::post('/admin/store',       [AdminController::class, 'store']);
Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy']);
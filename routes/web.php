<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProgresoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DocenteAuthController;
use App\Http\Middleware\DocenteAuth;

Route::get('/', function () { return view('juego'); });
Route::post('/login-check',         [AuthController::class, 'login']);
Route::post('/tutorial-completado', [AuthController::class, 'marcarTutorial']);
Route::post('/progreso/guardar',   [ProgresoController::class, 'guardar']);
Route::post('/progreso/consultar', [ProgresoController::class, 'consultar']);

Route::get('/docente/login',  [DocenteAuthController::class, 'showLogin']);
Route::post('/docente/login', [DocenteAuthController::class, 'login']);
Route::post('/docente/logout',[DocenteAuthController::class, 'logout']);

Route::middleware([DocenteAuth::class])->group(function () {
    Route::get('/admin',                        [AdminController::class, 'index']);
    Route::post('/admin/store',                 [AdminController::class, 'store']);
    Route::delete('/admin/delete/{id}',         [AdminController::class, 'destroy']);
    Route::post('/admin/permisos/{role_id}',    [AdminController::class, 'updatePermisos']);
});
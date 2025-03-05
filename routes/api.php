<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;


// Rutas de autenticacion
Route::post('login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//Rutas de usuario protegidas por atenticacion
Route::middleware('auth:sanctum')->group(function () {
Route::apiResource('usuarios', UsuarioController::class);
});

/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/
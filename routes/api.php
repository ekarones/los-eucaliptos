<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioPermiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UsuarioPermisoController;


//acceso mediaten login con token
Route::post('login', [AuthController::class, 'login']);



//permisos de usuario
Route::apiResource('permisos', UsuarioPermiso::class);
Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('permisos_usuario', UsuarioPermisoController::class);


/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/
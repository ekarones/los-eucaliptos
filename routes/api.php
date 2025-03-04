<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioPermiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;


//acceso mediante login
Route::post('login', [AuthController::class, 'login']);

Route::apiResource('usuarios', UsuarioController::class);


/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProyectoApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('jwt')->get('/perfil', function (Request $request) {
    return response()->json([
        'message' => 'Acceso autorizado',
        'usuario' => auth('api')->user(),
    ]);
});

Route::middleware('jwt')->post('/logout', [AuthController::class, 'logout']);

Route::apiResource('proyectos', ProyectoApiController::class)->names('api.proyectos');
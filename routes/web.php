<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;

// pantalla de inicio 
Route::get('/', function () {
    return view('inicio');
})->name('inicio');

// vistas de autenticacion :v
Route::get('/login', function () {
    return view('auth.login');
})->name('login.view');

Route::get('/register', function () {
    return view('auth.register');
})->name('register.view');

// listamos todos los proyectos de JS
Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');
Route::get('/proyectos/crear', [ProyectoController::class, 'create'])->name('proyectos.create');
Route::get('/proyectos/{id}', [ProyectoController::class, 'show'])->name('proyectos.show');
Route::get('/proyectos/{id}/editar', [ProyectoController::class, 'edit'])->name('proyectos.edit');
Route::get('/proyectos/{id}/eliminar', [ProyectoController::class, 'confirmDelete'])->name('proyectos.confirmDelete');

// acciones protegidas con el middleware jwt
Route::middleware('jwt')->group(function () {
    Route::post('/proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');
    Route::put('/proyectos/{id}', [ProyectoController::class, 'update'])->name('proyectos.update');
    Route::delete('/proyectos/{id}', [ProyectoController::class, 'destroy'])->name('proyectos.destroy');
});
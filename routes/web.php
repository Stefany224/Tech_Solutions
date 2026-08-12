<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;

Route::get('/', function () {
    return redirect()->route('proyectos.index');
});

// Listamos todos los proyectos
Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');

// el formulario para crear
Route::get('/proyectos/crear', [ProyectoController::class, 'create'])->name('proyectos.create');

// guardamos el proyecto nuevo 
Route::post('/proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');

// obtenemos un proyecto por id
Route::get('/proyectos/{id}', [ProyectoController::class, 'show'])->name('proyectos.show');

// el formulario para editar
Route::get('/proyectos/{id}/editar', [ProyectoController::class, 'edit'])->name('proyectos.edit');

// actualizar un proyecto por id
Route::put('/proyectos/{id}', [ProyectoController::class, 'update'])->name('proyectos.update');

// confirmamos antes de eliminar un proyecto
Route::get('/proyectos/{id}/eliminar', [ProyectoController::class, 'confirmDelete'])->name('proyectos.confirmDelete');

// y eliminamos un proyecto por id
Route::delete('/proyectos/{id}', [ProyectoController::class, 'destroy'])->name('proyectos.destroy');

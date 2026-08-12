<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    // Listamos todos los proyectos
    public function index()
    {
        return view('proyectos.index', ['proyectos' => Proyecto::all()]);
    }

    // Mostramos el formulario para crear
    public function create()
    {
        return view('proyectos.create');
    }

    // se guarda el proyecto nuevo 
    public function store(Request $request) {
    Proyecto::create([
        'nombre' => $request->nombre,
        'fecha_inicio' => $request->fecha_inicio,
        'estado' => $request->estado,
        'responsable' => $request->responsable,
        'monto' => $request->monto,
    ]);

    return redirect()->route('proyectos.index')->with('mensaje', 'Proyecto agregado correctamente');
    }

    // msotramos un proyecto por id
    public function show($id) {
        $proyecto = Proyecto::find($id);
        return view('proyectos.show', ['proyecto' => $proyecto]);
    }

    // mostramos el formulario para editar
    public function edit($id)
    {
        $proyecto = Proyecto::find($id);
        return view('proyectos.edit', ['proyecto' => $proyecto]);
    }

    // actualizamos un proyecto 
    public function update(Request $request, $id) {
    Proyecto::update($id, [
        'nombre' => $request->nombre,
        'fecha_inicio' => $request->fecha_inicio,
        'estado' => $request->estado,
        'responsable' => $request->responsable,
        'monto' => $request->monto,
    ]);

    return redirect()->route('proyectos.index')->with('mensaje', 'Proyecto actualizado correctamente');
    }

    // Muestra confirmación de eliminación
    public function confirmDelete($id) {
        $proyecto = Proyecto::find($id);
        return view('proyectos.delete', ['proyecto' => $proyecto]);
    }

    // y eliminamos un proyecto 
    public function destroy($id) {
    Proyecto::delete($id);

    return redirect()->route('proyectos.index')->with('mensaje', 'Proyecto eliminado correctamente');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    // listamos todos los proyectos
    public function index()
    {
        $proyectos = Proyecto::orderBy('created_at', 'desc')->get();

        return view('proyectos.index', ['proyectos' => $proyectos]);
    }

    // mostramos el formulario para poder crear
    public function create()
    {
        return view('proyectos.create');
    }

    // se guarda el proyecto nuevo
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:150',
            'fecha_inicio' => 'required|date',
            'estado' => 'required|string',
            'responsable' => 'required|string|max:150',
            'monto' => 'required|integer|min:0',
        ]);

        // Si la peticion trae un JWT que es válido (por ejemplo: probando con Postman), auth('api')->id()
        // devuelve el id real del usuario. Si no trae token, devuelve null (columna nullable).
        $validated['created_by'] = auth('api')->id();

        Proyecto::create($validated);

        return redirect()->route('proyectos.index')->with('mensaje', 'Proyecto agregado correctamente');
    }

    // msotramos un proyecto por el id
    public function show($id)
    {
        $proyecto = Proyecto::findOrFail($id);

        return view('proyectos.show', ['proyecto' => $proyecto]);
    }

    // mostramos el formulario para poder editar
    public function edit($id)
    {
        $proyecto = Proyecto::findOrFail($id);

        return view('proyectos.edit', ['proyecto' => $proyecto]);
    }

    // actualizamos un proyecto
    public function update(Request $request, $id)
    {
        $proyecto = Proyecto::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:150',
            'fecha_inicio' => 'required|date',
            'estado' => 'required|string',
            'responsable' => 'required|string|max:150',
            'monto' => 'required|integer|min:0',
        ]);

        $proyecto->update($validated);

        return redirect()->route('proyectos.index')->with('mensaje', 'Proyecto actualizado correctamente');
    }

    //muestra confirmacion de la eliminación
    public function confirmDelete($id)
    {
        $proyecto = Proyecto::findOrFail($id);

        return view('proyectos.delete', ['proyecto' => $proyecto]);
    }

    // y eliminamos un proyecto
    public function destroy($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->delete();

        return redirect()->route('proyectos.index')->with('mensaje', 'Proyecto eliminado correctamente');
    }
}

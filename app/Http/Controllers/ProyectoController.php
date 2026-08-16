<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    //listamos todos los proyectos
    public function index()
    {
        $proyectos = Proyecto::orderBy('created_at', 'desc')->get();

        return view('proyectos.index', ['proyectos' => $proyectos]);
    }

    //mostramos el formulario para poder crear
    public function create()
    {
        return view('proyectos.create');
    }

    //con esto guarda el proyecto nuevo y aquí están las validaciones. sí, está vez las pusimos profe y ya están bien :'3
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:150|regex:/^[\pL\s]+$/u',
            'fecha_inicio' => 'required|date',
            'estado' => 'required|string',
            'responsable' => 'required|string|max:150|regex:/^[\pL\s]+$/u',
            'monto' => 'required|integer|min:1',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'responsable.required' => 'El responsable es obligatorio.',
            'responsable.regex' => 'El responsable solo puede contener letras y espacios.',
            'monto.required' => 'El monto es obligatorio.',
            'monto.integer' => 'El monto debe ser un numero.',
            'monto.min' => 'El monto debe ser mayor que cero.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'estado.required' => 'El estado es obligatorio.',
        ]);
        $validated['created_by'] = auth('api')->id();
        Proyecto::create($validated);
        return redirect()->route('proyectos.index')->with('mensaje', 'Proyecto agregado correctamente');
    }

    //mostramos un proyecto por el id
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

    //actualizamos un proyecto
    public function update(Request $request, $id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $validated = $request->validate([
            'nombre' => 'required|string|max:150|regex:/^[\pL\s]+$/u',
            'fecha_inicio' => 'required|date',
            'estado' => 'required|string',
            'responsable' => 'required|string|max:150|regex:/^[\pL\s]+$/u',
            'monto' => 'required|integer|min:1',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'responsable.required' => 'El responsable es obligatorio.',
            'responsable.regex' => 'El responsable solo puede contener letras y espacios.',
            'monto.required' => 'El monto es obligatorio.',
            'monto.integer' => 'El monto debe ser un numero.',
            'monto.min' => 'El monto debe ser mayor que cero.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'estado.required' => 'El estado es obligatorio.',
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
    //y eliminamos un proyecto
    public function destroy($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->delete();
        return redirect()->route('proyectos.index')->with('mensaje', 'Proyecto eliminado correctamente');
    }
}

@extends('layouts.app')

@section('titulo', 'Editar Proyecto')

@section('contenido')

    <div class="max-w-lg rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        <form action="{{ route('proyectos.update', $proyecto->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <x-atoms.input-field label="Nombre" name="nombre" :value="$proyecto->nombre" />
            <x-atoms.input-field label="Fecha de inicio" name="fecha_inicio" type="date" min="2020-01-01" max="2035-12-31" :value="$proyecto->fecha_inicio" />
            <x-atoms.select-field
                label="Estado"
                name="estado"
                :options="['Pendiente', 'En curso', 'Finalizado']"
                :selected="$proyecto->estado"
            />
            <x-atoms.input-field label="Responsable" name="responsable" :value="$proyecto->responsable" />
            <x-atoms.input-field label="Monto" name="monto" type="number" :min="0" :value="$proyecto->monto" />
            <div class="flex items-center gap-3 pt-2">
                <x-atoms.button color="amber">Actualizar</x-atoms.button>
                <a href="{{ route('proyectos.index') }}" class="text-sm text-gray-500 hover:underline">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

@endsection
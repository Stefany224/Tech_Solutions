@extends('layouts.app')

@section('titulo', 'Agregar Proyecto')

@section('contenido')

    <div class="max-w-lg rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        <form action="{{ route('proyectos.store') }}" method="POST" class="space-y-4">
            @csrf
            <x-atoms.input-field label="Nombre" name="nombre" />
            <x-atoms.input-field label="Fecha de inicio" name="fecha_inicio" type="date" />

            <x-atoms.select-field
                label="Estado"
                name="estado"
                :options="['Pendiente', 'En curso', 'Finalizado']"
            />
            <x-atoms.input-field label="Responsable" name="responsable" />
            <x-atoms.input-field label="Monto" name="monto" type="number" :min="0" />

            <div class="flex items-center gap-3 pt-2">
                <x-atoms.button color="blue">Guardar</x-atoms.button>
                <a href="{{ route('proyectos.index') }}" class="text-sm text-gray-500 hover:underline">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

@endsection
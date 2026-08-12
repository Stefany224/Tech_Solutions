@extends('layouts.app')

@section('titulo', 'Eliminar Proyecto')

@section('contenido')

    <div class="max-w-lg rounded-xl border border-red-200 bg-red-50 p-6">

        <h2 class="mb-2 text-lg font-semibold text-gray-800">
            ¿Eliminar este proyecto?
        </h2>
        <p class="mb-6 text-sm text-gray-600">
            Estás a punto de eliminar
            <span class="font-medium text-gray-800">{{ $proyecto['nombre'] }}</span>.
            Esta accion no se puede deshacer.
        </p>

        <form action="{{ route('proyectos.destroy', $proyecto['id']) }}" method="POST" class="flex gap-3">
            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700"
            >
                Si, eliminar
            </button>
            <a href="{{ route('proyectos.index') }}" class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50">
                Cancelar
            </a>
        </form>

    </div>

@endsection

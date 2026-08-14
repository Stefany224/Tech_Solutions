@extends('layouts.app')

@section('titulo', 'Eliminar Proyecto')

@section('contenido')

    <div class="max-w-lg rounded-xl border border-red-200 bg-red-50 p-6">

        <h2 class="mb-2 text-lg font-semibold text-gray-800">
            ¿eliminar este proyecto?
        </h2>
        <p class="mb-6 text-sm text-gray-600">
            Estas a punto de eliminar
            <span class="font-medium text-gray-800">{{ $proyecto->nombre }}</span>.
            Esta accion no se puede deshacer
        </p>

        <form action="{{ route('proyectos.destroy', $proyecto->id) }}" method="POST" class="flex flex-col gap-3 sm:flex-row">
            @csrf
            @method('DELETE')

            <x-atoms.button color="red">si, eliminar</x-atoms.button>
            <a href="{{ route('proyectos.index') }}" class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50">
                cancelar
            </a>
        </form>

    </div>

@endsection


@extends('layouts.app')

@section('titulo', 'Editar Proyecto')

@section('contenido')

    <div class="max-w-lg rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        <form action="{{ route('proyectos.update', $proyecto['id']) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="nombre" class="mb-1 block text-sm font-medium text-gray-700">Nombre</label>
                <input
                    type="text" id="nombre" name="nombre" value="{{ $proyecto['nombre'] }}" required
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                >
            </div>

            <div>
                <label for="fecha_inicio" class="mb-1 block text-sm font-medium text-gray-700">Fecha de inicio</label>
                <input
                    type="date" id="fecha_inicio" name="fecha_inicio" value="{{ $proyecto['fecha_inicio'] }}" required
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                >
            </div>

            <div>
                <label for="estado" class="mb-1 block text-sm font-medium text-gray-700">Estado</label>
                <select
                    id="estado" name="estado" required
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                >
                    @foreach (['Pendiente', 'En curso', 'Finalizado'] as $opcion)
                        <option value="{{ $opcion }}" @selected($proyecto['estado'] === $opcion)>
                            {{ $opcion }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="responsable" class="mb-1 block text-sm font-medium text-gray-700">Responsable</label>
                <input
                    type="text" id="responsable" name="responsable" value="{{ $proyecto['responsable'] }}" required
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                >
            </div>

            <div>
                <label for="monto" class="mb-1 block text-sm font-medium text-gray-700">Monto</label>
                <input
                    type="number" id="monto" name="monto" min="0" value="{{ $proyecto['monto'] }}" required
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                >
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button
                    type="submit"
                    class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-white hover:bg-amber-600"
                >
                    Actualizar
                </button>
                <a href="{{ route('proyectos.index') }}" class="text-sm text-gray-500 hover:underline">
                    Cancelar
                </a>
            </div>

        </form>
    </div>

@endsection

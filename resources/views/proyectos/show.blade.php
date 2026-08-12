@extends('layouts.app')

@section('titulo', 'Detalle del Proyecto')

@section('contenido')

    <div class="max-w-lg rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

        <h2 class="mb-4 text-lg font-semibold text-gray-800">{{ $proyecto['nombre'] }}</h2>

        <dl class="space-y-3 text-sm">
            <div class="flex justify-between border-b border-gray-100 pb-2">
                <dt class="text-gray-500">Fecha de inicio</dt>
                <dd class="font-medium text-gray-800">{{ $proyecto['fecha_inicio'] }}</dd>
            </div>
            <div class="flex justify-between border-b border-gray-100 pb-2">
                <dt class="text-gray-500">Estado</dt>
                <dd>
                    <span class="inline-flex rounded-full bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700">
                        {{ $proyecto['estado'] }}
                    </span>
                </dd>
            </div>
            <div class="flex justify-between border-b border-gray-100 pb-2">
                <dt class="text-gray-500">Responsable</dt>
                <dd class="font-medium text-gray-800">{{ $proyecto['responsable'] }}</dd>
            </div>
            <div class="flex justify-between pb-2">
                <dt class="text-gray-500">Monto</dt>
                <dd class="font-medium text-gray-800">$ {{ number_format($proyecto['monto'], 0, ',', '.') }}</dd>
            </div>
        </dl>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('proyectos.edit', $proyecto['id']) }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-white hover:bg-amber-600">
                Editar
            </a>
            <a href="{{ route('proyectos.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50">
                Volver al listado
            </a>
        </div>

    </div>

@endsection

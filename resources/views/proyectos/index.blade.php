@extends('layouts.app')

@section('titulo', 'Listado de Proyectos')

@section('contenido')

    <div class="mb-8">
        <x-uf-widget />
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-100 text-xs uppercase tracking-wide text-gray-500">
                <tr>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Fecha inicio</th>
                    <th class="px-4 py-3">Estado</th>
                    <th class="px-4 py-3">Responsable</th>
                    <th class="px-4 py-3">Monto</th>
                    <th class="px-4 py-3 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($proyectos as $p)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $p['nombre'] }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $p['fecha_inicio'] }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex rounded-full bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700">
                                {{ $p['estado'] }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ $p['responsable'] }}</td>
                        <td class="px-4 py-3 text-gray-500">
                            $ {{ number_format($p['monto'], 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex justify-end gap-3 text-sm">
                                <a href="{{ route('proyectos.show', $p['id']) }}" class="font-medium text-blue-600 hover:underline">
                                    Ver
                                </a>
                                <a href="{{ route('proyectos.edit', $p['id']) }}" class="font-medium text-amber-600 hover:underline">
                                    Editar
                                </a>
                                <a href="{{ route('proyectos.confirmDelete', $p['id']) }}" class="font-medium text-red-600 hover:underline">
                                    Eliminar
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-400">
                            Aun no hay proyectos registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection

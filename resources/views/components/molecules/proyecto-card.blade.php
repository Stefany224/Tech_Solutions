@props(['id', 'nombre', 'fechaInicio', 'estado', 'responsable', 'monto'])

<div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
    <div>
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-lg font-bold text-slate-800">{{ $nombre }}</h3>
            <span class="bg-blue-50 text-blue-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                {{ $estado }}
            </span>
        </div>
        <p class="text-slate-500 text-sm">inicio: <span class="font-medium text-slate-700">{{ $fechaInicio }}</span></p>
        <p class="text-slate-500 text-sm">responsable: <span class="font-medium text-slate-700">{{ $responsable }}</span></p>
    </div>
    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
        <span class="text-sm font-bold text-slate-700">$ {{ number_format($monto, 0, ',', '.') }}</span>
        <div class="flex gap-3 text-sm">
            <a href="{{ route('proyectos.show', $id) }}" class="font-medium text-blue-600 hover:underline">Ver</a>
            <a href="{{ route('proyectos.edit', $id) }}" class="font-medium text-amber-600 hover:underline">Editar</a>
            <a href="{{ route('proyectos.confirmDelete', $id) }}" class="font-medium text-red-600 hover:underline">Eliminar</a>
        </div>
    </div>
</div>
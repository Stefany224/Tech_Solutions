@extends('layouts.app')

@section('titulo', 'Listado de Proyectos')

@section('contenido')

    <div class="mb-8">
        <x-uf-widget />
    </div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full">
    @forelse ($proyectos as $p)
        <x-molecules.proyecto-card
            :id="$p->id"
            :nombre="$p->nombre"
            :fechaInicio="$p->fecha_inicio"
            :estado="$p->estado"
            :responsable="$p->responsable"
            :monto="$p->monto"
        />
    @empty
        <div class="col-span-full text-center py-12 text-slate-400">
            Aun no hay proyectos registrados.
        </div>
    @endforelse
</div>

@endsection

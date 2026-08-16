@extends('layouts.app')
@section('contenido')

    <div class="min-h-[75vh] flex items-center justify-center">

        <x-molecules.welcome-card
            titulo="Tech Solutions Proyectos"
            subtitulo="Bienvenido, para acceder a tus proyectos, inicia sesion o registrate" >
            
            <x-atoms.link-button :href="route('login.view')" color="outline">
                Inicio Sesion
            </x-atoms.link-button>

            <x-atoms.link-button :href="route('register.view')" color="outline">
                Regístrate
            </x-atoms.link-button>
        </x-molecules.welcome-card>

    </div>

@endsection
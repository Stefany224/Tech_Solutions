@extends('layouts.app')

@section('contenido')

    <x-molecules.auth-card
        titulo="Registrarse"
        subtitulo="Crea tu cuenta para empezar a usar el sistema"
    >
        <x-atoms.error-box />

        <form id="form-register" class="space-y-4">
            <x-atoms.input-field label="Nombre" name="nombre" type="text" />
            <x-atoms.input-field label="Correo" name="correo" type="email" />
            <x-atoms.input-field label="Contraseña" name="clave" type="password" />

            <div class="pt-2">
                <x-atoms.button color="blue" class="w-full">
                    Crear Cuenta
                </x-atoms.button>
            </div>
        </form>

        <p class="text-center text-sm text-slate-500 mt-6">
            ¿Ya tienes cuenta?
            <a href="{{ route('login.view') }}" class="text-blue-600 font-semibold hover:underline">Inicia sesion</a>
        </p>

    </x-molecules.auth-card>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        enviarFormularioAuth('form-register', '/api/register', () => {
            window.location.href = '{{ route('login.view') }}';
        });
    });
</script>
@endpush
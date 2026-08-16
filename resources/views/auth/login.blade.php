@extends('layouts.app')

@section('contenido')

    <x-molecules.auth-card
        titulo="Iniciar Sesion"
        subtitulo="Ingresa tus datos para acceder a tus proyectos" >
        <x-atoms.error-box />

        <form id="form-login" class="space-y-4">
            <x-atoms.input-field label="Correo" name="correo" type="email" />
            <x-atoms.input-field label="Contraseña" name="clave" type="password" />

            <div class="pt-2">
                <x-atoms.button color="blue" class="w-full">
                    Iniciar Sesion
                </x-atoms.button>
            </div>
        </form>

        <p class="text-center text-sm text-slate-500 mt-6">
            ¿No tienes cuenta?
            <a href="{{ route('register.view') }}" class="text-blue-600 font-semibold hover:underline">Registrate aqui</a>
        </p>

    </x-molecules.auth-card>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        enviarFormularioAuth('form-login', '/api/login', (data) => {
            localStorage.setItem('token', data.token);
            window.location.href = '{{ route('proyectos.index') }}';
        });
    });
</script>
@endpush
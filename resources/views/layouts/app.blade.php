<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Tech Solutions') | Gestion de Proyectos</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    class="min-h-screen text-gray-800 antialiased flex flex-col bg-cover bg-center bg-fixed"
    style="background-image: url('{{ asset('images/fondo-geometrico.webp') }}');" >

    <x-molecules.navbar>
        @yield('nav-extra')
    </x-molecules.navbar>

    <main class="mx-auto max-w-5xl px-6 py-8 flex-grow w-full">

        @if (session('mensaje'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('mensaje') }}
            </div>
        @endif

        @hasSection('titulo')
            <h1 class="mb-6 text-2xl font-bold text-gray-800">
                @yield('titulo')
            </h1>
        @endif

        @yield('contenido')

    </main>

    <footer class="mt-16 border-t border-gray-200 py-6 text-center text-xs text-gray-400 bg-white">
        Tech Solutions &copy; {{ date('Y') }} 
    </footer>

    @if(request()->routeIs('proyectos.*'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                protegerPagina();
            });
        </script>
    @endif

  @stack('scripts')
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Tech Solutions') | Gestion de Proyectos</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 text-gray-800 antialiased">

    <nav class="border-b border-gray-200 bg-white">
        <div class="mx-auto flex max-w-5xl items-center justify-between px-6 py-4">
            <a href="{{ route('proyectos.index') }}" class="text-lg font-bold text-gray-800">
                Tech <span class="text-blue-600">Solutions</span>
            </a>
            <a
                href="{{ route('proyectos.create') }}"
                class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700"
            >
                + Agregar Proyecto
            </a>
        </div>
    </nav>

    <main class="mx-auto max-w-5xl px-6 py-8">

        @if (session('mensaje'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('mensaje') }}
            </div>
        @endif

        <h1 class="mb-6 text-2xl font-bold text-gray-800">
            @yield('titulo', 'Gestion de Proyectos')
        </h1>

        @yield('contenido')

    </main>

    <footer class="mt-16 border-t border-gray-200 py-6 text-center text-xs text-gray-400">
        Tech Solutions &copy; {{ date('Y') }} 
    </footer>

</body>
</html>

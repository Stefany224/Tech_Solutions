<nav class="border-b border-gray-200 bg-white">
    <div class="mx-auto flex max-w-5xl items-center justify-between px-6 py-4">
       <span class="text-lg font-bold text-gray-800">
            Tech <span class="text-blue-600">Solutions</span>
        </span>

        <div class="flex items-center gap-4">
            <a href="{{ route('inicio') }}" id="link-inicio" class="text-base font-semibold text-gray-600 hover:text-blue-600 transition duration-200">
                Inicio
            </a>

            <button
                id="btn-logout"
                class="hidden text-sm font-semibold text-red-600 hover:text-red-700 transition duration-200">
                Cerrar sesion
            </button>

             {{ $slot }}

        </div>
    </div>
</nav>
@props(['titulo', 'subtitulo'])

<div class="bg-white border-2 border-slate-900 rounded-2xl px-14 py-12 max-w-lg w-full mx-4 text-center shadow-lg">

    <h1 class="text-3xl font-extrabold text-slate-900 mb-4 tracking-tight">
        {{ $titulo }}
    </h1>

    <p class="text-slate-500 mb-10 leading-relaxed">
        {{ $subtitulo }}
    </p>

    <div class="flex justify-center gap-5 mb-10">
        {{ $slot }}
    </div>

    <a href="#" class="text-blue-600 text-sm hover:underline">
        Terminos y Condiciones
    </a>

</div>
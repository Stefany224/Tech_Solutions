@props(['titulo', 'subtitulo'])

<div class="min-h-[75vh] flex items-center justify-center">

    <div class="bg-white border-2 border-slate-900 rounded-2xl px-10 py-10 max-w-md w-full mx-4 shadow-lg">

        <h1 class="text-2xl font-extrabold text-slate-900 text-center mb-2">
            {{ $titulo }}
        </h1>
        <p class="text-slate-500 text-center text-sm mb-8">
            {{ $subtitulo }}
        </p>

        {{ $slot }}

    </div>

</div>
@props(['href', 'color' => 'outline'])

@php
    $colores = [
        'blue' => 'bg-blue-600 hover:bg-blue-700 text-white',
        'outline' => 'border-2 border-slate-900 text-slate-900 hover:bg-slate-900 hover:text-white',
    ];
@endphp


   <a href="{{ $href }}"
    class="{{ $colores[$color] }} font-bold py-3 px-8 rounded-lg transition duration-200 text-sm inline-block">
    {{ $slot }}
</a>
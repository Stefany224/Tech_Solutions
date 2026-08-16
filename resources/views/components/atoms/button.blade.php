@props(['color' => 'blue'])

@php
    $colores = [
        'blue' => 'bg-blue-600 hover:bg-blue-700 text-white',
        'amber' => 'bg-amber-500 hover:bg-amber-600 text-white',
        'red' => 'bg-red-600 hover:bg-red-700 text-white',
        'outline' => 'border-2 border-slate-900 text-slate-900 hover:bg-slate-900 hover:text-white',
    ];
@endphp

<button
    type="submit"
    {{ $attributes->merge(['class' => $colores[$color] . ' font-bold py-2.5 px-5 rounded-lg transition duration-200 cursor-pointer text-sm']) }}
>
    {{ $slot }}
</button>
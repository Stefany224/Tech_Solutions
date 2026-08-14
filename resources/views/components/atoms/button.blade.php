@props(['color' => 'blue'])

@php
    $colores = [
        'blue' => 'bg-blue-600 hover:bg-blue-700',
        'amber' => 'bg-amber-500 hover:bg-amber-600',
        'red' => 'bg-red-600 hover:bg-red-700',
    ];
@endphp

<button
    type="submit"
    class="{{ $colores[$color] }} text-white font-bold py-2.5 px-5 rounded-lg transition duration-200 cursor-pointer text-sm"
>
    {{ $slot }}
</button>
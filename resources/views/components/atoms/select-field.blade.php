@props(['label', 'name', 'options', 'selected' => null])

@php
    $valorActual = old($name, $selected);
@endphp

<div>
    <label for="{{ $name }}" class="mb-1 block text-sm font-medium text-gray-700">{{ $label }}</label>
    <select
        id="{{ $name }}" name="{{ $name }}" required
        class="w-full rounded-lg border px-3 py-2 text-sm focus:outline-none focus:ring-1
            {{ $errors->has($name) ? 'border-red-400 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500' }}"
    >
        @if(!$valorActual)
            <option value="" disabled selected>Selecciona un {{ strtolower($label) }}</option>
        @endif
        @foreach ($options as $opcion)
            <option value="{{ $opcion }}" @selected($valorActual === $opcion)>
                {{ $opcion }}
            </option>
        @endforeach
    </select>
    @error($name)
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
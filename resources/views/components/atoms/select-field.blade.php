@props(['label', 'name', 'options', 'selected' => null])

<div>
    <label for="{{ $name }}" class="mb-1 block text-sm font-medium text-gray-700">{{ $label }}</label>
    <select
        id="{{ $name }}" name="{{ $name }}" required
        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
    >
        @if(!$selected)
            <option value="" disabled selected>Selecciona un {{ strtolower($label) }}</option>
        @endif
        @foreach ($options as $opcion)
            <option value="{{ $opcion }}" @selected($selected === $opcion)>
                {{ $opcion }}
            </option>
        @endforeach
    </select>
</div>
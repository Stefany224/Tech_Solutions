@props(['label', 'type' => 'text', 'name', 'value' => '', 'min' => null])

<div>
    <label for="{{ $name }}" class="mb-1 block text-sm font-medium text-gray-700">{{ $label }}</label>
    <input
        type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ $value }}"
        @if($min !== null) min="{{ $min }}" @endif
        required
        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
    >
</div>
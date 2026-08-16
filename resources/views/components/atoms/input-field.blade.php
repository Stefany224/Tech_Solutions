@props(['label', 'type' => 'text', 'name', 'value' => '', 'min' => null])

<div>
    <label for="{{ $name }}" class="mb-1 block text-sm font-medium text-gray-700">{{ $label }}</label>
    <input
        type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}"
        @if($min !== null) min="{{ $min }}" @endif
        required
        class="w-full rounded-lg border px-3 py-2 text-sm focus:outline-none focus:ring-1
            {{ $errors->has($name) ? 'border-red-400 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500' }}"
    >
    @error($name)
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
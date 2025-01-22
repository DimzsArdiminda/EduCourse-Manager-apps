@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-gray-900 dark:text-gray-100']) }}>
    {{ $value ?? $slot }}
</label>

@props(['type' => 'submit'])

<button type="{{ $type }}" {{ $attributes->merge(['class' => 'default-button']) }}>
    {{ $slot }}
</button>

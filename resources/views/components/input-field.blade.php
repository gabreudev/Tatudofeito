<div class="form-field">
    @if ($type === 'textarea')
        <textarea
            id="{{ $name }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            {{ $attributes }}
        >{{ old($name, $value ?? '') }}</textarea>
    @else
        <input
            type="{{ $type }}"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ $type === 'password' ? '' : old($name, $value ?? '') }}"
            placeholder="{{ $placeholder }}"
            {{ $attributes }}
        >
    @endif
</div>

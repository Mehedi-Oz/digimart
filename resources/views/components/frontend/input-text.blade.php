<div class="form_box">
    <label for="{{ $id }}" class="form-label mb-2 font-18 font-heading fw-600">{{ $label }}
        @if ($required)
            <code>*</code>
        @endif
    </label>
    <input type="{{ $type }}" {{ $attributes->class(['common-input', 'is-invalid' => $errors->has($name)]) }}
        id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}">
    <x-input-error :messages="$errors->first($name)" />
</div>

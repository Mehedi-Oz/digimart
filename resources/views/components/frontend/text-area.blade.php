<div class="form_box">
    <label for="{{ $label }}" class="form-label mb-2 font-18 font-heading fw-600">{{ $label }}
        @if ($required)
            <code>*</code>
        @endif
    </label>
    <textarea {{ $attributes->class(['common-input', 'is-invalid' => $errors->has($name)]) }} name="{{ $name }}"
        placeholder="{{ $placeholder }}">{!! $value !!}</textarea>
    <x-input-error :messages="$errors->first($name)" />
</div>

<div class="form_box">
    <label for="{{ $name }}" class="form-label mb-2 font-18 font-heading fw-600">{{ $label }}
        @if ($required)
            <code>*</code>
        @endif
    </label>
    <div class="">
        <select {{ $attributes->class(['common-input', 'is-invalid' => $errors->has($name)]) }}
            name="{{ $name }}" {{ $required ? 'required' : ' ' }}>
            <option value="" disabled selected>{{ __('Select Document Type') }}</option>
            {{ $slot }}
        </select>
        <x-input-error :messages="$errors->first($name)" />
    </div>
</div>

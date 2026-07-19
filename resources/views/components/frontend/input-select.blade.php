<div class="form_box">
    <label for="{{ $name }}" class="form-label mb-2 font-18 font-heading fw-600">{{ $label }}</label>
    <div class="">
        <select {{ $attributes->class(['common-input', 'is-invalid' => $errors->has($name)]) }}
            name="{{ $name }}">
            <option value="">{{ __('Select') }}</option>
            {{ $slot }}
        </select>
        <x-input-error :messages="$errors->first($name)" />
    </div>
</div>

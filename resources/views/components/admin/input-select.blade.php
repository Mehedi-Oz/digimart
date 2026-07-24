<div class="mb-3">
    <label class="form-label">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $name }}"
        {{ $attributes->class(['form-control form-select', 'is-invalid' => $errors->has($name)]) }}>
        <option value="" disabled>{{ __('Select') }}</option>
        {{ $slot }}
    </select>
    <x-input-error :messages="$errors->first($name)" />
</div>

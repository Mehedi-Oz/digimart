<label class="form-check">
    <input class="form-check-input {{ $errors->has($name) ? 'is-invalid' : '' }}" type="checkbox"
        name="{{ $name }}" value="{{ $value }}" {{ $attributes }}>
    <span class="form-check-label">{{ $label }}</span>
</label>
<x-input-error :messages="$errors->first($name)" />

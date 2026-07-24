<div class="mb-3">
    <label class="form-check form-switch form-switch-3">
        <input type="hidden" name="{{ $name }}" value="0">
        <input name="{{ $name }}" {{ $attributes->merge(['class' => 'form-check-input']) }} type="checkbox" value="1" @checked($checked)>
        <span class="form-check-label">{{ $label }}</span>
    </label>
    <x-input-error :messages="$errors->first($name)" />
</div>

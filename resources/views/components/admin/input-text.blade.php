<div class="mb-3">
    <label class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" {{ $attributes }}
        {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }} id="{{ $id }}"
        name="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ $value }}">
    <x-input-error :messages="$errors->first($name)" />
</div>

<div class="mb-3 mb-0">
    <label class="form-label">{{ $label }}</label>
    <textarea rows="5" {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
        placeholder="{{ $placeholder }}" name={{ $name }}>{{ $value }}</textarea>
    <x-input-error :messages="$errors->first($name)" />
</div>

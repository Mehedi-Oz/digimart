@php
    $isMultiple = $attributes->has('multiple');
    $id = trim(preg_replace('/[^A-Za-z0-9_.-]/', '_', $name), '_');
@endphp
<div class="form_box">
    <label for="{{ $id }}" class="form-label mb-2 font-18 font-heading fw-600">{{ $label }}
        @if ($required)
            <code>*</code>
        @endif
    </label>
    <div class="">
        <select {{ $attributes->class(['common-input', 'is-invalid' => $errors->has($name)]) }}
            id="{{ $id }}" name="{{ $name }}" {{ $required ? 'required' : '' }}>
            @if (!$isMultiple)
                <option value="" disabled selected>{{ __('Select') }}</option>
            @endif
            {{ $slot }}
        </select>
        <x-input-error :messages="$errors->first($name)" />
    </div>
</div>

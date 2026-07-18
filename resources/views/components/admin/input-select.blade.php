{{-- <div class="form_box">
    <label for="{{ $name }}" class="form-label mb-2 font-18 font-heading fw-600">{{ $label }}</label>
    <div class="">
        <select {{ $attributes->merge(['class' => 'common-input border']) }} name="{{ $name }}">
            <option value="">{{ __('Select') }}</option>
            {{ $slot }}
        </select>
        <x-input-error :messages="$errors->first('country')" />
    </div>
</div> --}}


<div class="mb-3">
    <label class="form-label">{{ $label }}</label>
    <select {{ $attributes->merge(['class' => 'form-control form-select']) }} name="{{ $name }}">
        <option value="">{{ __('Select') }}</option>
        {{ $slot }}
    </select>
    <x-input-error :messages="$errors->first($name)" />
</div>

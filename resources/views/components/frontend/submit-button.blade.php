@props(['label' => __('Submit')])

<button type="submit" {{ $attributes->merge(['class' => 'btn btn-primary']) }}>
    {{ $label }}
</button>

@props(['src'])

<img src="{{ asset($src) }}"
    {{ $attributes->merge([
        'class' => 'img-fluid',
        'style' => 'object-fit: cover',
    ]) }}>

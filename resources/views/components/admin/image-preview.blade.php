@props(['src'])

<img
    src="{{ str_starts_with($src, 'defaults/')
        ? asset($src)
        : asset('uploads/' . $src) }}"
    {{ $attributes->merge([
        'class' => 'image-fluid',
        'style' => 'object-fit:cover',
    ]) }}
>

@props([
    'src' => '',
    'alt' => '',
])

@if (filled($src))
    <figure {{ $attributes->merge(['class' => 'image']) }}>
        <img src="{{ $src }}" alt="{{ $alt }}" loading="lazy">
    </figure>
@endif


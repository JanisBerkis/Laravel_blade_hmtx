@props([
    'text' => '',
])

<p {{ $attributes->merge(['class' => 'text']) }}>
    {!! nl2br(e($text)) !!}
</p>


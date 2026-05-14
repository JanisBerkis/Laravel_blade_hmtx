@props([
    'level' => 'h2',
    'text' => '',
])

@php
    $level = in_array($level, ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'], true) ? $level : 'h2';
@endphp

@switch($level)
    @case('h1')
        <h1 {{ $attributes->merge(['class' => 'heading heading--h1']) }}>{{ $text }}</h1>
        @break
    @case('h2')
        <h2 {{ $attributes->merge(['class' => 'heading heading--h2']) }}>{{ $text }}</h2>
        @break
    @case('h3')
        <h3 {{ $attributes->merge(['class' => 'heading heading--h3']) }}>{{ $text }}</h3>
        @break
    @case('h4')
        <h4 {{ $attributes->merge(['class' => 'heading heading--h4']) }}>{{ $text }}</h4>
        @break
    @case('h5')
        <h5 {{ $attributes->merge(['class' => 'heading heading--h5']) }}>{{ $text }}</h5>
        @break
    @default
        <h6 {{ $attributes->merge(['class' => 'heading heading--h6']) }}>{{ $text }}</h6>
@endswitch


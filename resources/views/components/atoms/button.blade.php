@props([
    'href' => null,
    'variant' => 'primary',
    'hxGet' => null,
    'hxPost' => null,
    'hxTarget' => null,
    'hxSwap' => null,
    'type' => 'button',
])

@php
    $classes = "btn btn--{$variant}";
@endphp

@if (filled($href))
    <a
        href="{{ $href }}"
        @if($hxGet) hx-get="{{ $hxGet }}" @endif
        @if($hxPost) hx-post="{{ $hxPost }}" @endif
        @if($hxTarget) hx-target="{{ $hxTarget }}" @endif
        @if($hxSwap) hx-swap="{{ $hxSwap }}" @endif
        {{ $attributes->merge(['class' => $classes]) }}
    >
        {{ $slot }}
    </a>
@else
    <button
        type="{{ $type }}"
        @if($hxGet) hx-get="{{ $hxGet }}" @endif
        @if($hxPost) hx-post="{{ $hxPost }}" @endif
        @if($hxTarget) hx-target="{{ $hxTarget }}" @endif
        @if($hxSwap) hx-swap="{{ $hxSwap }}" @endif
        {{ $attributes->merge(['class' => $classes]) }}
    >
        {{ $slot }}
    </button>
@endif


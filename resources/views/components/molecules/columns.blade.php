@props([
    'count' => 2,
    'data' => [],
])

@php
    $count = in_array((int) $count, [2, 3, 4], true) ? (int) $count : 2;
@endphp

<section class="columns columns--{{ $count }}">
    @for ($i = 1; $i <= $count; $i++)
        <div class="columns__col">
            <x-molecules.content-blocks :blocks="$data['column_' . $i] ?? []" />
        </div>
    @endfor
</section>


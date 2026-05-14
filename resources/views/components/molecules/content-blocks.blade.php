@props([
    'blocks' => [],
])

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@foreach ($blocks as $block)
    @php
        $type = $block['type'] ?? null;
        $data = $block['data'] ?? [];
    @endphp

    @if ($type === 'heading')
        <x-atoms.heading :level="$data['level'] ?? 'h2'" :text="$data['text'] ?? ''" />
    @elseif ($type === 'text')
        <x-atoms.text :text="$data['text'] ?? ''" />
    @elseif ($type === 'image')
        @if (! empty($data['image']))
            <x-atoms.image :src="Storage::disk('public')->url($data['image'])" :alt="$data['alt'] ?? ''" />
        @endif
    @elseif ($type === 'columns')
        <x-molecules.columns :count="$data['count'] ?? 2" :data="$data" />
    @endif
@endforeach


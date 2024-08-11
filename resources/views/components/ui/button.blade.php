@props(['title', 'url', 'type'])

<a href="{{ $url ?? '#' }}">
    <button type="{{ $type ?? "button" }}"
        {{ $attributes->merge(['class' => 'px-3 py-1.5 rounded text-xs shadow tracking-wide font-medium duration-200 transition-colors']) }}>{{ $slot }}</button>
</a>

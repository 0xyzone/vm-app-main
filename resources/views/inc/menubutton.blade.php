@php
    $string = $_SERVER['REQUEST_URI'];
    
@endphp

<a class="w-full text-white items-center flex gap-4 hover:bg-amber-600 rounded-lg px-5 py-2.5 smooth text-2xl @if (str_contains(url()->current(), $item['path'])) bg-amber-600 @else bg-gray-800 @endif"
    @if (str_contains(url()->current(), $item['path'])) @else href="/{{ $item['path'] }}" @endif>
    <i class="w-10 text-center {{ $item['icon_class'] }}"></i>
    <span class="text-lg font-normal">{{ $item['name'] }}</span>
</a>

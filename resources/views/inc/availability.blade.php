@php
    $availability = [
        [
            'status' => 'Available',
            'color' => 'bg-gray-300',
        ],
        [
            'status' => 'Reserved',
            'color' => 'bg-amber-500',
        ],
        [
            'status' => 'Ocupied',
            'color' => 'bg-gray-600',
        ],
    ];
@endphp

@foreach ($availability as $item)
    <span class="flex items-center gap-1">
        <div class="w-3 h-3 rounded {{ $item['color'] }}"></div> {{ $item['status'] }}
    </span>
@endforeach

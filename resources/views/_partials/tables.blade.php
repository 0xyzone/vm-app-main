<div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-4 gap-4 pb-10 px-6">
    @foreach ($tables as $table)
        <a @if ($table['availability'] == 'Occupied') @else href="/tables/{{ $table['id'] }} @endif"
            class="bg-gray-200 rounded-lg flex gap-4 items-center p-4 @if ($table['availability'] == 'Occupied') bg-gray-600 @elseif($table['availability'] == 'Reserved') bg-amber-500 hover:scale-105 hover:bg-gray-500/50 @elseif($table['availability'] == 'Available') hover:text-white hover:scale-105 hover:bg-gray-500/50 @endif smooth group">
            @if ($table['availability'] == 'Available')
                <i class="fa-duotone fa-lock-open fa-4x !hidden lg:!inline-block"
                    style="--fa-primary-color: #4CAF50;"></i>
                <i class="fa-duotone fa-lock-open fa-3x lg:!hidden" style="--fa-primary-color: #4CAF50;"></i>
            @elseif($table['availability'] == 'Occupied')
                <i class="fa-duotone fa-lock fa-4x !hidden lg:!inline-block"
                    style="--fa-primary-color: #B71C1C;"></i>
                <i class="fa-duotone fa-lock fa-2x lg:!hidden" style="--fa-primary-color: #B71C1C;"></i>
            @elseif($table['availability'] == 'Reserved')
                <i
                    class="fa-solid fa-book-bookmark fa-4x !hidden lg:!inline-block text-amber-800 group-hover:text-amber-500 smooth"></i>
                <i
                    class="fa-solid fa-book-bookmark fa-2x lg:!hidden text-amber-800 group-hover:text-amber-500 smooth"></i>
            @endif
            <div class="flex flex-col h-full w-full justify-center gap-1">
                <p
                    class="lg:text-4xl font-thin @if ($table['availability'] == 'Occupied') text-gray-200 @elseif($table['availability'] == 'Reserved') group-hover:text-gray-200 smooth @endif">
                    {{ $table['name'] }}</p>
                <div
                    class="text-xs @if ($table['availability'] == 'Reserved') text-amber-800  smooth @elseif($table['availability'] == 'Occupied') text-gray-500 @endif text-gray-400 lg:pl-1.5 group-hover:text-white smooth">
                    Floor:
                    <span class="font-bold">{{ $table['floor'] }}</span>
                    <span class="gap-1 text-xs font-thin inline-flex">
                        <i class="fa-solid fa-loveseat lg:pl-1.5 text-gray-700 group-hover:text-white smooth"></i>
                    </span><span class="font-bold"> {{ $table['seats'] }} </span> seats
                </div>

            </div>
        </a>
    @endforeach
</div>
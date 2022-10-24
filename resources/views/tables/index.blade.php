<x-layout>
    <div class="flex justify-between items-center md:mb-6">
        <p class="text-white font-bold text-2xl">Tables</p>
        <div class="md:flex gap-4 text-white w-4/12 items-center hidden">
            <span class="flex items-center gap-1">
                <div class="w-3 h-3 rounded-full bg-gray-300"></div> Available
            </span>
            <span class="flex items-center gap-1">
                <div class="w-3 h-3 rounded-full bg-amber-500"></div> Reserved
            </span>
            <span class="flex items-center gap-1">
                <div class="w-3 h-3 rounded-full bg-gray-600"></div> Occupied
            </span>
        </div>
        <a href="/tables/add" class="btn-primary text-white">Add Table</a>
    </div>
    <div class="w-full flex gap-4 text-white items-center md:hidden justify-center my-3">
        <span class="flex items-center gap-1">
            <div class="w-3 h-3 rounded-full bg-gray-300"></div> Available
        </span>
        <span class="flex items-center gap-1">
            <div class="w-3 h-3 rounded-full bg-amber-500"></div> Reserved
        </span>
        <span class="flex items-center gap-1">
            <div class="w-3 h-3 rounded-full bg-gray-600"></div> Occupied
        </span>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-2 2xl:grid-cols-4 gap-4 pb-10">
        @foreach ($tables as $table)
            <a @if($table['availability'] == 'Occupied') @else href="/tables/{{ $table['id'] }} @endif"
                class="bg-gray-200 rounded-lg flex gap-4 items-center p-4 @if ($table['availability'] == 'Occupied') bg-gray-600 @elseif($table['availability'] == 'Reserved') bg-amber-500 hover:scale-105 hover:bg-gray-500/50 @elseif($table['availability'] == 'Available') hover:text-white hover:scale-105 hover:bg-gray-500/50 @endif smooth group">
                @if ($table['availability'] == 'Available')
                    <i class="fa-duotone fa-lock-open fa-4x !hidden lg:!inline-block" style="--fa-primary-color: #4CAF50;"></i>
                    <i class="fa-duotone fa-lock-open fa-2x lg:!hidden" style="--fa-primary-color: #4CAF50;"></i>
                @elseif($table['availability'] == 'Occupied')
                    <i class="fa-duotone fa-lock fa-4x !hidden lg:!inline-block" style="--fa-primary-color: #B71C1C;"></i>
                    <i class="fa-duotone fa-lock fa-2x lg:!hidden" style="--fa-primary-color: #B71C1C;"></i>
                @elseif($table['availability'] == 'Reserved')
                    <i class="fa-solid fa-book-bookmark fa-4x !hidden lg:!inline-block text-amber-800 group-hover:text-amber-500 smooth"></i>
                    <i class="fa-solid fa-book-bookmark fa-2x lg:!hidden text-amber-800 group-hover:text-amber-500 smooth"></i>
                @endif
                <div class="flex flex-col h-full w-full justify-center">
                    <p class="lg:text-3xl lg:text-4xl font-thin @if($table['availability'] == 'Occupied') text-gray-200 @elseif($table['availability'] == 'Reserved') group-hover:text-gray-200 smooth @endif">Table No.{{ $table['name'] }}</p>
                    <p
                        class="text-xs @if ($table['availability'] == 'Reserved') text-amber-800 group-hover:text-white smooth @elseif($table['availability'] == 'Occupied') text-gray-500 @endif text-gray-400 lg:pl-1.5">
                        Floor: <span class="font-bold">{{ $table['floor'] }}</span><br class="lg:hidden"> <span class="@if($table['availability'] == 'Available') text-green-500 @elseif($table['availability'] == 'Occupied') text-gray-300  smooth @endif">• {{ $table['availability'] }}</span></p>
                </div>
            </a>
        @endforeach
    </div>
    
    <div class="mt-6">
        {{ $tables->links('pagination::tailwind') }}
    </div>
</x-layout>

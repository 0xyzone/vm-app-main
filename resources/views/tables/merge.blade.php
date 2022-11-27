@php
    $table_no = explode(',', $order->table);
@endphp


<x-layout :title="$title">
    <div class="text-white text-2xl">
        Merge Tables
    </div>
    <form action="/orders/{{ $order->id }}/merge/update" method="POST"
        class="mt-6 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-2" id="merge">
        @csrf
        @foreach ($tables as $table)
            @if (in_array("$table->id", $table_no) ||
                $table->availability == 'Occupied' ||
                $table->availability == 'Reserved')
                @continue
            @endif
            <div class="bg-transparent rounded-lg flex gap-4 items-center p-4 hover:text-white hover:scale-[101%] hover:bg-gray-500/50 smooth group border border-current text-white"
                id="table_div{{ $table->id }}">
                <input type="checkbox" class="peer" name="table[]" id="table{{ $table->id }}"
                    value="{{ $table->id }}" hidden>
                <i class="fa-duotone fa-lock-open !hidden lg:!inline-block" style="--fa-primary-color: #4CAF50;"
                    id="talcha-{{ $table->id }}"></i>
                <i class="fa-duotone fa-lock-open lg:!hidden" style="--fa-primary-color: #4CAF50;"></i>
                <div class="flex flex-col h-full w-full justify-center gap-1">
                    <p class="font-bold lg:font-thin smooth" id="info-p-{{ $table->id }}">
                        {{ $table['name'] }}
                    </p>
                </div>
            </div>
            <script>
                $('#table_div{{ $table->id }}').click(function() {
                    if ($('#table{{ $table->id }}').prop('checked') == false) {
                        $('#table{{ $table->id }}').prop('checked', true);

                        $('#table_div{{ $table->id }}').addClass('bg-lime-500/50');
                        $('#table_div{{ $table->id }}').removeClass(
                            'bg-gray-200 hover:text-white hover:bg-gray-500/50');
                        $('#talcha-{{ $table->id }}').removeClass('fa-lock-open').addClass('fa-lock');
                    } else {
                        $('#table{{ $table->id }}').prop('checked', false);

                        $('#table_div{{ $table->id }}').removeClass('bg-lime-500/50');
                        $('#table_div{{ $table->id }}').addClass(
                            'bg-gray-200 hover:text-white hover:bg-gray-500/50');
                        $('#talcha-{{ $table->id }}').addClass('fa-lock-open').removeClass('fa-lock');
                    }
                })
            </script>
        @endforeach
    </form>
    @error('table')
        <p class="py-2 text-xs text-rose-600 mt-2">{{$message}}</p>
    @enderror
    <button form="merge" type="submit" class="btn-secondary mt-6 text-amber-500 hover:bg-amber-600 hover:text-white hover:border-amber-600">Merge</button>
</x-layout>

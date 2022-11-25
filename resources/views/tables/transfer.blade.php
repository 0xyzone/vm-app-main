@php
    $table_no = explode(',', $order_no['table']);
@endphp


<x-layout :title="$title">
    <div class="text-white text-2xl">
        Transfer Tables
    </div>
    <div class="mt-6 grid grid-cols-2 gap-2">

        @foreach ($tables as $table)
            <div class="bg-gray-200 rounded-lg flex gap-4 items-center p-4 hover:text-white hover:scale-[101%] hover:bg-gray-500/50 smooth group"
                id="table_div{{ $table->id }}">
                <input type="checkbox" class="peer" name="table[]" id="table{{ $table->id }}"
                    value="{{ $table->id }}" hidden>
                <i class="fa-duotone fa-lock-open fa-4x !hidden lg:!inline-block" style="--fa-primary-color: #4CAF50;"
                    id="talcha-{{ $table->id }}"></i>
                <i class="fa-duotone fa-lock-open fa-2x lg:!hidden" style="--fa-primary-color: #4CAF50;"></i>
                <div class="flex flex-col h-full w-full justify-center gap-1">
                    <p class="lg:text-4xl font-bold lg:font-thin group-hover:text-gray-200 smooth"
                        id="info-p-{{ $table->id }}">
                        {{ $table['name'] }} {{ $table->id }}
                    </p>
                </div>
            </div>
            <script>
                $('#table_div{{ $table->id }}').click(function() {
                    if ($('#table{{ $table->id }}').prop('checked') == false) {
                        $('#table{{ $table->id }}').prop('checked', true);
                        $('#info-p-{{ $table->id }}').removeClass('group-hover:text-gray-200');

                        $('#table_div{{ $table->id }}').addClass('bg-amber-500');
                        $('#table_div{{ $table->id }}').removeClass(
                            'bg-gray-200 hover:text-white hover:bg-gray-500/50');
                        $('#talcha-{{ $table->id }}').removeClass('fa-lock-open').addClass('fa-lock');
                    } else {
                        $('#table{{ $table->id }}').prop('checked', false);
                        $('#info-p-{{ $table->id }}').addClass('group-hover:text-gray-200');

                        $('#table_div{{ $table->id }}').removeClass('bg-amber-500');
                        $('#table_div{{ $table->id }}').addClass(
                            'bg-gray-200 hover:text-white hover:bg-gray-500/50');
                        $('#talcha-{{ $table->id }}').addClass('fa-lock-open').removeClass('fa-lock');
                    }
                })
            </script>
        @endforeach
    </div>
</x-layout>

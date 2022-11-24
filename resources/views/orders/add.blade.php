<x-layout :title="$title">
    <div class="px-10 max-w-lg mx-auto pb-4 overflow-y-auto overflow-x-hidden">
        <h2 class="text-2xl font-bold text-white uppercase text-center my-5">
            Add new Order
        </h2>
    </div>
    <form method="POST" action="/orders/store">
        @csrf
        <div class="mb-6 flex flex-col">
            <label class="text-white text-4xl pb-4">
                Choose Table
            </label>
            <div class="grid grid-cols-2 md:grid-cols-2 2xl:grid-cols-4 gap-4 pb-10">
                @foreach ($tables as $table)
                    @if ($table['availability'] == 'Occupied')
                        @continue
                    @endif
                    <div class="bg-gray-200 rounded-lg flex gap-4 items-center p-4 hover:text-white hover:scale-105 hover:bg-gray-500/50 smooth group"
                        id="table_div{{ $table['id'] }}">
                        <input type="checkbox" class="peer" name="table[]" id="table{{ $table['id'] }}"
                            value="{{ $table['id'] }}" hidden>
                        <i class="fa-duotone fa-lock-open fa-4x !hidden lg:!inline-block"
                            style="--fa-primary-color: #4CAF50;" id="talcha-{{$table['id']}}"></i>
                        <i class="fa-duotone fa-lock-open fa-2x lg:!hidden" style="--fa-primary-color: #4CAF50;"></i>
                        <div class="flex flex-col h-full w-full justify-center gap-1">
                            <p
                                class="lg:text-4xl font-bold lg:font-thin group-hover:text-gray-200 smooth" id="info-p-{{$table->id}}">
                                {{ $table['name'] }}</p>
                            <div
                                class="text-sm text-gray-500 group-hover:text-white smooth" id="info-{{$table->id}}">
                                Floor:
                                <span class="font-bold">{{ $table['floor'] }}</span>
                                <span class="gap-1 text-xs font-thin inline-flex">
                                    <i
                                        class="fa-solid fa-loveseat lg:pl-1.5 text-gray-700 group-hover:text-white smooth" id="i-{{$table->id}}"></i>
                                </span><span class="font-bold"> {{ $table['seats'] }} </span> seats
                            </div>

                        </div>
                    </div>
                    <script>
                        $('#table_div{{ $table->id }}').click(function() {
                            if ($('#table{{ $table['id'] }}').prop('checked') == false) {
                                $('#table{{ $table['id'] }}').prop('checked', true);
                                $('#info-p-{{ $table['id'] }}').removeClass('group-hover:text-gray-200');
                                $('#info-{{ $table['id'] }}').removeClass('group-hover:text-white text-gray-500');
                                $('#i-{{ $table['id'] }}').removeClass('group-hover:text-white text-gray-700');
                                $('#table_div{{ $table['id'] }}').addClass('bg-amber-500 scale-105');
                                $('#table_div{{ $table['id'] }}').removeClass('bg-gray-200 hover:text-white hover:scale-105 hover:bg-gray-500/50');
                                $('#talcha-{{$table['id']}}').removeClass('fa-lock-open').addClass('fa-lock');
                            } else {
                                $('#table{{ $table['id'] }}').prop('checked', false);
                                $('#info-p-{{ $table['id'] }}').addClass('group-hover:text-gray-200');
                                $('#info-{{ $table['id'] }}').addClass('group-hover:text-white text-gray-500');
                                $('#i-{{ $table['id'] }}').addClass('group-hover:text-white text-gray-700');
                                $('#table_div{{ $table['id'] }}').removeClass('bg-amber-500 scale-105');
                                $('#table_div{{ $table['id'] }}').addClass('bg-gray-200 hover:text-white hover:scale-105 hover:bg-gray-500/50');
                                $('#talcha-{{$table['id']}}').addClass('fa-lock-open').removeClass('fa-lock');
                            }
                        })
                    </script>
                @endforeach
            </div>

            <div class="mb-6">
                <button for="add" type="submit"
                    class="text-white  border border-sky-200 rounded py-2 px-4 mt-4 hover:bg-black">
                    Place Order
                </button>
            </div>
    </form>
</x-layout>

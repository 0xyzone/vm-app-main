<x-layout>
    <div class="px-10 max-w-lg mx-auto pb-10 overflow-y-auto overflow-x-hidden">
        <h2 class="text-2xl font-bold text-white uppercase text-center my-5">
            Add new Order
        </h2>
    </div>
    <form method="POST" action="/orders/store">
        @csrf
        <div class="mb-6 flex flex-col">
            <label class="text-white">
                Table no.
            </label>
            <div class="flex gap-4 mt-2">
                @foreach ($tables as $table)
                    @if ($table['availability'] == 'Occupied')
                        @continue
                    @endif
                    <div class="flex gap-2 border border-amber-500 p-2 rounded-lg cursor-pointer"
                        id="table_div{{ $table['id'] }}">
                        <input type="checkbox" name="table" id="table{{ $table['id'] }}" value="{{ $table['id'] }}" hidden>
                        <label for="table{{ $table['id'] }}">Table {{ $table['name'] }}</label>
                    </div>

                    <script>
                        $('#table_div{{ $table->id }}').click(function() {
                            $('#table{{$table['id']}}').attr('checked', 'checked');
                            if ($('#table{{ $table['id'] }}').prop('checked')) {
                                console.log('isChecked');
                                $('#table_div{{ $table['id'] }}').addClass('bg-amber-500');
                            } else {
                                $('#table_div{{ $table['id'] }}').removeClass('bg-amber-500');
                            }
                        })
                    </script>
                @endforeach
            </div>
        </div>

        <!-- <div class="mb-6">
            <label for="customer" class="text-white">
                Choose a customer
            </label>
            <select name="customer" id="customer" class="border border-gray-200 rounded p-2 w-full">
                <option value="" disabled selected hidden>Please Choose an option.</option>
                @foreach ($customers as $customer)
<option value="{{ $customer['id'] }}" @if (old('customer') === $customer['id']) selected @else @endif>
                        {{ $customer['name'] }}</option>
@endforeach
            </select>
        </div> -->


        <div class="mb-6">
            <label for="item" class="text-white">
                Choose items:
            </label>
            {{-- Search Bar --}}
            <input type="search" name="search" class="border border-gray-200 rounded p-2 w-full my-2"
                placeholder="Search Items..." id="search">
            {{-- end search bar --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-2" id="content_all">
                @foreach ($items as $item)
                    <x-card class="flex-col">
                        <!-- <img src="{{ asset('storage/' . $item->image) }}" alt="item image" class="w-32"
                            onerror="this.onerror=null;this.src='{{ asset('img/logo.png') }}';"> -->
                        <div class="p-4 flex flex-col items-center">
                            <p class="text-black  text-center">
                                {{ $item['name'] }}
                            </p>
                            {{ $item['price'] }}
                        </div>
                    </x-card>
                @endforeach
            </div>
            <div class="mt-6" id="content_all_links">
                {{ $items->links() }}
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-2" id="content">
            </div>
        </div>

        <div class="mb-6">
            <button for="add" type="submit"
                class="text-white  border border-sky-200 rounded py-2 px-4 mt-4 hover:bg-black">
                Place Order
            </button>
        </div>
    </form>
    <script class="text/javascript">
        $('#search').on('keyup', function() {
            $value = $(this).val();
            if ($value) {
                $('#content_all').hide();
                $('#content_all_links').hide();
                $('#content').show();
            } else {
                $('#content_all').show();
                $('#content_all_links').show();
                $('#content').hide();
            };
            $.ajax({
                type: 'get',
                url: '{{ URL::to('/search/item') }}',
                data: {
                    'search': $value
                },

                success: function(data) {
                    $('#content').html(data);
                }
            });
        })
    </script>
</x-layout>

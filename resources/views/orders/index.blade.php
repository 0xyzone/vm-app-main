<x-layout>
    @include('_partials.search')
    <script>
        $('#search').on('keyup', function() {
            $value = $(this).val();
            if ($value) {
                $('#results').show();
            } else {
                $('#results').hide();
            };
            $.ajax({
                type: 'get',
                url: '{{ URL::to('/search/orders') }}',
                data: {
                    'search': $value
                },

                success: function(data) {
                    $('#results').html(data);
                }
            });
        })
    </script>
    <div class="w-full flex flex-col gap-4 justify-center">
        <div class="justify-between flex w-full text-xl font-bold text-gray-300 items-center">
            <p>Orders</p>
            <a href="/orders/add" class="btn-primary"> Add Orders</a>
        </div>

        <table class="w-full hidden md:inline-block">
            <thead class="w-full">
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal w-full">
                    <td class="tabledata">id</td>
                    <td class="tabledata w-3/12">Tables</td>
                    <td class="tabledata w-3/12">Payment Status</td>
                    <td class="tabledata w-3/12">Created At</td>
                    <td class="tabledata w-3/12">
                        <div class="flex gap-4 justify-center w-full">
                            Action
                        </div>
                    </td>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @if ($orders->count() == 0)
                    <tr class="hover:bg-gray-200 odd:bg-gray-100 even:bg-gray-300">
                        <td class="user-td" colspan="5">No record found!</td>
                    </tr>
                @endif
                @foreach ($orders as $order)
                @if ($order->status == 'Completed')
                    @continue
                @endif
                    <tr class="hover:bg-gray-200 odd:bg-gray-100 even:bg-gray-300 font-normal cursor-pointer"
                        id="order_{{ $order->id }}">
                        <td class="user-td">{{ $order->id }}</td>
                        <td class="user-td flex flex-wrap gap-2">
                            @php
                                $table_no = explode(',', $order->table);
                            @endphp

                            @foreach ($table_no as $table)
                                @foreach ($tables as $tab)
                                    @if ($table == $tab['id'])
                                        <p class="p-2 rounded-full border w-max border-amber-500">{{ $tab['name'] }}
                                        </p>
                                    @endif
                                @endforeach
                            @endforeach
                        </td>
                        <td class="user-td">
                            @if ($order->payment == 'Paid')
                                <span class="px-2 py-1 border border-current text-lime-500 rounded-lg text-sm">
                                    <i class="fa-duotone fa-badge-check fa-swap-opacity"></i> Paid
                                </span>
                            @else
                                <span class="px-2 py-1 border border-current text-gray-400 rounded-lg text-sm">
                                    <i class="fa-duotone fa-hourglass-half"></i> Unpaid
                                </span>
                            @endif
                        </td>
                        <td class="user-td">{{ $order->created_at->format('jS M Y | g : i a') }}</td>
                        <td class="user-td">
                            <div class="flex gap-4 justify-center w-full">
                                <a href="orders/{{ $order->id }}/edit"><i
                                        class="fa-solid fa-edit hover:text-amber-600 hover:font-bold smooth"></i></a>
                                <form method="POST" action="/orders/{{ $order->id }}/delete">
                                    @csrf
                                    @method('DELETE')
                                    <button id="delete"
                                        onclick="return confirm('Are you sure you want to delete this record?')"> <i
                                            class="fa-regular fa-trash smooth hover:text-rose-600"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <script>
                        $('#order_{{ $order->id }}').click(function() {
                            location.href = 'orders/{{ $order->id }}/additems';
                        })
                    </script>
                @endforeach
                {{ $orders->links() }}
            </tbody>
        </table>
        @foreach ($orders as $order)
            <x-card id="order_{{ $order->id }}_mob" class="lg:hidden block">
                <div class="flex gap-2 items-center flex-1 w-full">
                    <div class="rounded-lg bg-gray-300 w-16 h-16 flex justify-center items-center font-bold shadow-lg">
                        {{ $order['id'] }}
                    </div>
                    <div class="flex flex-col flex-1 w-full gap-2">
                        <span class="font-bold">Tables:</span>
                        <div class="text-[0.9rem] font-light grid grid-cols-2 gap-2">
                            @php
                                $table_no = explode(',', $order->table);
                            @endphp

                            @foreach ($table_no as $table)
                                @foreach ($tables as $tab)
                                    @if ($table == $tab['id'])
                                        <span
                                            class="p-2 rounded-full border w-full border-amber-500 shadow-md">{{ $tab['name'] }}</span>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                        <p class="text-[0.7rem] font-bold text-gray-400">
                            {{ $order->created_at->format('jS M Y | g : i a') }}</p>
                    </div>

                </div>
            </x-card>
            <script>
                $('#order_{{ $order->id }}_mob').click(function() {
                    location.href = 'orders/{{ $order->id }}/additems';
                })
            </script>
        @endforeach
    </div>
</x-layout>

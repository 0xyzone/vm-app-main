<x-layout class="pb-20">
    <form action="additems" method="POST" class="mb-6" id="orderItems">
        @csrf
        <label for="item" class="text-white">
            Choose items:
        </label>
        {{-- Search Bar --}}
        <input type="search" name="search" class="border border-gray-200 rounded p-2 w-full my-2"
            placeholder="Search Items..." id="search">
        {{-- end search bar --}}
        <ul class="grid grid-cols-1 md:grid-cols-4 gap-2 mt-2 list-none" id="content">
        </ul>
        <div class="flex gap-2 mt-4">
            <input type="number" name="qty" id="qty" placeholder="Enter quantity"
                class="border border-gray-200 rounded p-2 w-full">
            <button type="submit" class="btn-primary">Add</button>
        </div>
        @error('qty')
            <p class="text-rose-400 text-xs ">
                {{ $message }}
            </p>
        @enderror
        <input type="number" name="order_no" id="order_no" value="{{ $order_no['id'] }}" hidden>
        <input type="text" name="status" id="status" value="pending" hidden>
    </form>
    <x-card class="flex-col !items-start">
        <div class="font-bold text-2xl pb-2 w-full">
            Order # {{ $order_no['id'] }}
        </div>
        <table class="table-auto text-xs w-full">
            <thead class="font-bold lg:text-sm">
                <tr class="bg-gray-400 w-full">
                    <td class="w-6/12 pl-2 broder-r-white border-r py-2">Items</td>
                    <td class="w-2/12 broder-r-white border-r text-center py-2">Qty.</td>
                    <td class="w-2/12 text-center py-2 broder-r-white border-r">Price</td>
                    <td class="w-2/12 text-center py-2">Amount</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderItems as $orderItem)
                    @if ($orderItem['order_id'] == $order_no['id'])
                        @foreach ($items as $item)
                            @if ($orderItem['item_id'] == $item['id'])
                                @php
                                    $item_name = $item['name'];
                                    $item_price = $item['price'];
                                    $amount = $orderItem['qty'] * $item['price'];
                                    $amounts[] = $orderItem['qty'] * $item['price'];
                                @endphp
                            @endif
                        @endforeach
                        <tr class="hover:bg-gray-200 odd:bg-gray-100 even:bg-gray-300">
                            <td class="user-td">{{ $item_name }}</td>
                            <td class="user-td text-center">
                                {{ $orderItem->qty }}
                                <form action="additems/{{$orderItem->id}}" method="post">
                                    @csrf
                                    @method('PUT')
                                <input type="number" name="price" id="price" value="{{$orderItem->qty}}">
                                </form></td>
                            <td class="user-td text-center">
                                {{ 'Rs. ' . $item_price }}
                            </td>
                            <td class="user-td text-left">{{ 'Rs. ' . $amount }}</td>
                        </tr>
                    @endif
                @endforeach

                @if (isset($amounts))
                    <tr class="bg-gray-400 font-bold text-xl">
                        <td class="broder-r-white border-r py-2 px-4 text-right" colspan="3">
                            Total
                        </td>
                        <td class="px-6">Rs. {{ array_sum($amounts) }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </x-card>
    {{-- Ajax Starting --}}
    <script class="text/javascript">
        $('#search').on('keyup', function() {
            $value = $(this).val();
            if ($value) {
                $('#content').show();
            } else {
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

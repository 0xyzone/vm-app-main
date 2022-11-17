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
                    <td class="w-1/12 broder-r-white border-r text-center py-2 px-2">Qty.</td>
                    <td class="w-3/12 text-center py-2 broder-r-white border-r">Price</td>
                    <td class="w-1/12 text-center py-2">Amount</td>
                </tr>
            </thead>
            <tbody class="lg:text-lg">
                @foreach ($orderItems as $orderItem)
                    @if ($orderItem['order_id'] == $order_no['id'])
                        @foreach ($items as $item)
                            @if ($orderItem['item_id'] == $item['id'])
                                @php
                                    $item_id = $item['id'];
                                    $item_name = $item['name'];
                                    $item_price = $item['price'];
                                    $amount = $orderItem['qty'] * $item['price'];
                                    $amounts[] = $orderItem['qty'] * $item['price'];
                                @endphp
                            @endif
                        @endforeach
                        <tr class="hover:bg-gray-200 odd:bg-gray-100 even:bg-gray-300">
                            <td class="pl-2 py-2">
                                <div class="px-1 rounded-full flex-1 inline items-center w-max mr-2 @if($orderItem['status'] == "pending")bg-yellow-500 @elseif($orderItem['status'] == "cooking")bg-blue-500 @elseif($orderItem['status'] == "served")bg-green-500 @endif"></div> {{ $item_name }} </td>
                            <td class="text-center">
                                <span class="@if(isset($_GET['edit']) && $_GET['edit'] == $orderItem->id) hidden @else flex flex-1 gap-2 justify-center @endif" id="span_{{$orderItem['id']}}">{{ $orderItem->qty }}<i
                                        class="fa-duotone fa-edit vm-theme" id="icon_{{$orderItem['id']}}"></i></span>
                                <form action="/orders/{{ $orderItem->id }}/additems/{{ $orderItem->id }}" method="post"
                                    class="@if(isset($_GET['edit']) && $_GET['edit'] == $orderItem->id) flex justify-center items-center gap-2 w-max @else hidden @endif" id="form_{{$orderItem->id}}">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="qty" id="qty" value="{{ $orderItem->qty }}" class="w-10 bg-gray-300 animate-pulse text-center">
                                    <button type="submit"><i class="fa-duotone fa-check vm-theme"></i></button>
                                </form>
                            </td>
                            <td class="text-center">
                                {{ 'Rs. ' . $item_price }}
                            </td>
                            <td class="text-left px-2">{{ 'Rs. ' . $amount }}</td>
                        </tr>
                        <script>
                            $("#icon_{{$orderItem['id']}}").click(function(){
                                location.replace('?edit={{$orderItem->id}}');
                            });
                        </script>
                    @endif
                @endforeach

                @if (isset($amounts))
                    <tr class="bg-gray-400 font-bold text-xl">
                        <td class="broder-r-white border-r py-2 px-4 text-right" colspan="3">
                            Total
                        </td>
                        <td class="flex px-2 w-max items-center py-2">Rs. {{ array_sum($amounts) }}</td>
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

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
        <ul class="grid grid-cols-1 md:grid-cols-4 gap-2 my-2 list-none hidden" id="content">
        </ul>
        @error('item')
            <p class="text-rose-400 text-xs ">
                {{ $message }}
            </p>
        @enderror
        <div class="flex gap-2 mt-4">
            <input type="number" name="qty" id="qty" placeholder="Enter quantity"
                class="border border-gray-200 rounded p-2 w-full">
            <button type="submit" class="btn-primary">Add</button>
        </div>
        @error('qty')
            <p class="text-rose-400 text-xs mt-2">
                {{ $message }}
            </p>
        @enderror
        <input type="number" name="order_no" id="order_no" value="{{ $order->id }}" hidden>
        <input type="text" name="status" id="status" value="pending" hidden>
    </form>
    <x-card class="flex-col !items-start">
        <div class="font-bold text-2xl pb-2 w-full flex flex-col lg:flex-row justify-between">
            <p>Order # {{ $order->id }}</p>
            <div class="flex gap-2 text-sm items-center font-thin">{{-- Index --}}
                <div class="flex gap-2 items-center">
                    <p class="font-bold">Item Status: </p>
                    <div class="w-max px-1 py-2 rounded-full bg-amber-500 flex-1 inline items-center"></div>
                    <p>Pending Item</p>
                </div>
                <div class="flex gap-2 items-center">
                    <div class="w-max px-1 py-2 rounded-full bg-blue-500 flex-1 inline items-center"></div>
                    <p>Cooking</p>
                </div>
                <div class="flex gap-2 items-center">
                    <div class="w-max px-1 py-2 rounded-full bg-green-500 flex-1 inline items-center"></div>
                    <p>
                        Cooked
                    </p>
                </div>
            </div>
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
                @foreach ($order->orderItems as $orderItem)
                    @if ($order->id == $orderItem->order_id)
                        @php
                            $amounts[] = $orderItem['qty'] * $orderItem->item->price;
                            
                        @endphp
                        <tr
                            class="hover:bg-gray-200 odd:bg-gray-100 even:bg-gray-300  @if ($orderItem->status == 'done') !bg-lime-300 @elseif($orderItem->status == 'cooking') animate-pulse @endif">
                            <td class="pl-2 py-2">
                                <div
                                    class="px-1 rounded-full flex-1 inline items-center w-max mr-2 @if ($orderItem->status == 'pending') bg-yellow-500 @elseif($orderItem->status == 'cooking')bg-blue-500 @elseif($orderItem->status == 'done')bg-green-500 @endif">
                                </div>
                                {{$orderItem->item->name}}
                            </td>
                            <td
                                class="text-center @if (isset($_GET['edit']) && $_GET['edit'] == $orderItem->id) flex justify-center items-center h-full pl-2 py-2 @endif">
                                <span
                                    class="@if (isset($_GET['edit']) && $_GET['edit'] == $orderItem->id) hidden @else flex flex-1 gap-2 justify-center @endif"
                                    id="span_{{ $orderItem->id }}">{{ $orderItem->qty }}
                                    @if ($orderItem->status == 'pending')
                                        <i class="fa-duotone fa-edit vm-theme hover:cursor-pointer" id="icon_{{ $orderItem->id }}"></i>
                                    @endif
                                </span>
                                <form action="/orders/{{ $orderItem->id }}/additems/{{ $orderItem->id }}" method="post"
                                    class="@if (isset($_GET['edit']) && $_GET['edit'] == $orderItem->id) flex justify-center items-center gap-2 w-max @else hidden @endif"
                                    id="form_{{ $orderItem->id }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="qty" id="qty" value="{{ $orderItem->qty }}"
                                        class="w-10 bg-gray-300 animate-pulse text-center">
                                    <button type="submit"><i class="fa-duotone fa-check vm-theme"></i></button>
                                </form>
                            </td>
                            <td class="text-center">
                                {{ 'Rs. ' . $orderItem->item->price }}
                            </td>
                            <td class="text-left px-2">{{'Rs. ' . $orderItem->qty * $orderItem->item->price }}</td>
                        </tr>
                        <script>
                            $("#icon_{{ $orderItem->id }}").click(function() {
                                location.replace('?edit={{ $orderItem->id }}');
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
        @if (isset($amounts))
            <div class="flex lg:justify-end justify-center mt-4 gap-4 w-full">
                <a href="/orders/{{$order->id}}/transfer" class="btn-secondary hover:scale-105">Transfer Table</a>
                <a href="" class="btn-secondary hover:scale-105">Mark as paid</a>
                <a href="" class="btn-secondary hover:scale-105">Complete</a>
            </div>
        @endif
    </x-card>

    {{-- Ajax Starting --}}
    <script class="text/javascript">
        $('#search').on('keyup', function() {
            $value = $(this).val();
            if ($value) {
                $('#content').removeClass('hidden');
                $('#content').show().removeClass('hidden');
            } else {
                $('#content').addClass('hidden');
                $('#content').hide().addClass('hidden');
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

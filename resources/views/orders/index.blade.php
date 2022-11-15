<x-layout>
    <div class="w-full flex flex-col gap-4 justify-center">
        <div class="justify-between flex w-full text-xl font-bold text-gray-300 items-center">
            <p>Orders</p>
            <a href="/orders/add" class="btn-primary"> Add Orders</a>
        </div>

        <table class="w-full mt-5 hidden md:inline-block">
            <thead class="w-full">
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal w-full">
                    <td class="tabledata">id</td>
                    <td class="tabledata w-3/12">Tables</td>
                    <td class="tabledata w-3/12">Customer</td>
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
                                        <p class="p-2 rounded-full border w-max border-amber-500">{{$tab['name']}}</p>
                                    @endif
                                @endforeach
                            @endforeach
                        </td>
                        <td class="user-td">{{ $order->customer }}</td>
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
    </div>
</x-layout>

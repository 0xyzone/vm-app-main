<x-layout>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="w-full">
            <div class="kitchen-titles">New Order</div>
            <div class="flex flex-col gap-2 mt-2 max-h-fit">
                @foreach ($orderItems as $orderItem)
                    @if ($orderItem['status'] == 'pending')
                        @foreach ($items as $item)
                            @if ($item['id'] == $orderItem['item_id'])
                                <x-card class="justify-between">
                                    <div class="flex gap-2 items-center">
                                        <div class="w-10 h-10 rounded-lg bg-gray-300 flex justify-center items-center">
                                            {{ $orderItem['id'] }}
                                        </div>
                                        <div class="grid grid-cols-2 border-separate gap-2">
                                            <div class="flex flex-col">
                                                <p class="font-bold">Order #{{ $orderItem['order_id'] }}</p>
                                                <p class="">{{ $item['name'] }}</p>
                                            </div>
                                            <div class="flex flex-col pl-2">
                                                <p class="font-bold">Qty.</p>
                                                <p class="font-normal">{{ $orderItem['qty'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="/orderitems/{{ $orderItem['id'] }}/update" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="status" id="status" value="cooking" hidden>
                                        <button type="submit"
                                            class="py-2 px-4 rounded-lg text-white hover:bg-lime-500 hover:text-gray-200 smooth text-xl bg-lime-600">Start</button>
                                    </form>
                                </x-card>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>
            <div class="my-4">
                {{ $orderItems->links() }}
            </div>
        </div>
        <div class="w-full">
            <div class="kitchen-titles">Cooking</div>
        </div>
        <div class="w-full">
            <div class="kitchen-titles">Done</div>
        </div>
    </div>
</x-layout>

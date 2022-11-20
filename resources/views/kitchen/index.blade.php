<x-layout>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="w-full">
            <div class="kitchen-titles">New Order</div>
            <div class="flex flex-col gap-2 mt-2 max-h-fit" id="new">
                @foreach ($pendings as $var)
                    <x-card class="justify-between">
                        <div class="flex gap-2 items-center">
                            <div class="w-10 h-10 rounded-lg bg-gray-300 flex justify-center items-center">
                                {{ $var->items->id }}
                            </div>
                            <div class="grid grid-cols-2 border-separate gap-2">
                                <div class="flex flex-col">
                                    <p class="font-bold">Order #{{ $var->order_id }}</p>
                                    <p class="">{{ $var->items->name }}</p>
                                </div>
                                <div class="flex flex-col pl-2">
                                    <p class="font-bold">Qty.</p>
                                    <p class="font-normal">{{ $var->qty }}</p>
                                </div>
                            </div>
                        </div>
                        <form action="/orderitems/{{ $var->id }}/update" method="post">
                            @csrf
                            @method('PUT')
                            <input type="text" name="status" id="status" value="cooking" hidden>
                            <button type="submit"
                                class="py-2 px-4 rounded-lg text-white hover:bg-amber-500 hover:text-gray-200 smooth text-xl bg-amber-600">Start</button>
                        </form>
                    </x-card>
                @endforeach
            </div>
            <script>
                function fetchdata(){
                    $.ajax({
                        url: '/ajax/kitchen_new',
                        type: 'get',
                        success: function(data){
                            $("#new").html(data)
                        }
                    })
                }
            </script>
            <div class="my-4">
                {{ $pendings->appends(['cookings' => $cookings->currentPage()])->appends(['dones' => $dones->currentPage()])->links() }}
            </div>
        </div>
        <div class="w-full">
            <div class="kitchen-titles">Cooking</div>
            <div class="flex flex-col gap-2 mt-2 max-h-fit" id="cooking">
                @foreach ($cookings as $var)
                    @foreach ($items as $item)
                        @if ($item['id'] == $var['item_id'])
                            <x-card class="justify-between">
                                <div class="flex gap-2 items-center">
                                    <div class="w-10 h-10 rounded-lg bg-gray-300 flex justify-center items-center">
                                        {{ $var['id'] }}
                                    </div>
                                    <div class="grid grid-cols-2 border-separate gap-2">
                                        <div class="flex flex-col">
                                            <p class="font-bold">Order #{{ $var['order_id'] }}</p>
                                            <p class="">{{ $item['name'] }}</p>
                                        </div>
                                        <div class="flex flex-col pl-2">
                                            <p class="font-bold">Qty.</p>
                                            <p class="font-normal">{{ $var['qty'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <form action="/orderitems/{{ $var['id'] }}/update" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="status" id="status" value="done" hidden>
                                    <button type="submit"
                                        class="py-2 px-4 rounded-lg text-white hover:bg-lime-500 hover:text-gray-200 smooth text-xl bg-lime-600">Done</button>
                                </form>
                            </x-card>
                        @endif
                    @endforeach
                @endforeach
            </div>
            <div class="my-4">
                {{ $cookings->appends(['pendings' => $cookings->currentPage()])->appends(['dones' => $dones->currentPage()])->links() }}
            </div>
        </div>
        <div class="w-full">
            <div class="kitchen-titles">Done</div>
            <div class="flex flex-col gap-2 mt-2 max-h-fit" id="done">
                @foreach ($dones as $var)
                    @foreach ($items as $item)
                        @if ($item['id'] == $var['item_id'])
                            <x-card class="justify-between">
                                <div class="flex gap-2 items-center">
                                    <div class="w-10 h-10 rounded-lg bg-gray-300 flex justify-center items-center">
                                        {{ $var['id'] }}
                                    </div>
                                    <div class="grid grid-cols-2 border-separate gap-2">
                                        <div class="flex flex-col">
                                            <p class="font-bold">Order #{{ $var['order_id'] }}</p>
                                            <p class="">{{ $item['name'] }}</p>
                                        </div>
                                        <div class="flex flex-col pl-2">
                                            <p class="font-bold">Qty.</p>
                                            <p class="font-normal">{{ $var['qty'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="py-2 px-4 rounded-lg smooth text-xl bg-transparent text-lime-600 border border-current font-bold">
                                    Completed
                                </div>
                            </x-card>
                        @endif
                    @endforeach
                @endforeach
            </div>
            <div class="my-4">
                {{ $dones->appends(['pendings' => $cookings->currentPage()])->appends(['cookings' => $dones->currentPage()])->links() }}
            </div>
        </div>
    </div>
</x-layout>
<script>
    // $(document).ready(function(){
    //     setInterval(fetchdata, 1000);
    // })
</script>

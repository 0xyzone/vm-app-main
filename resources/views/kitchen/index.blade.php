<x-layout>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="w-full">
            <div class="kitchen-titles">New Order</div>
            <div class="flex flex-col gap-2 mt-2 max-h-fit" id="new">
                @foreach ($pendings as $var)
                    <x-card class="justify-between">
                        @include('_partials.orderItems')
                        <a href="/orderitems/{{ $var->id }}/update/cooking" class="py-2 px-4 rounded-lg text-white hover:bg-amber-500 hover:text-gray-200 smooth text-xl bg-amber-600">Start</a>
                    </x-card>
                @endforeach
            </div>
            <script>
                function fetchdata() {
                    $.ajax({
                        url: '/ajax/kitchen_new',
                        type: 'get',
                        success: function(data) {
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
                                @include('_partials.orderItems')
                                <a href="/orderitems/{{ $var->id }}/update/cooked" class="py-2 px-4 rounded-lg text-white hover:bg-lime-500 hover:text-gray-200 smooth text-xl bg-lime-600">Done</a>
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
                    @php
                        $today = date('Y-m-d');
                        $date = strtotime($var['updated_at']);
                        $compare = date('Y-m-d', $date);
                    @endphp
                    @if ($today == $compare)
                        <x-card class="justify-between">
                            @include('_partials.orderItems')
                        </x-card>
                    @endif
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
    //     setInterval(fetchdata, 10000);
    // })
</script>

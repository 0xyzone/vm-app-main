<div class="flex gap-2 items-center relative">
    <div class="w-10 h-10 rounded-lg bg-gray-300 flex justify-center items-center self-start">
        {{ $var->order_id }}
    </div>
    <div class="grid grid-cols-1 border-separate gap-2">
        <div class="flex flex-col">
            <p class="font-bold text-xl">{{ $var->item->name }}</p>
            @php
                $table_no = explode(',', $var->order->table);
            @endphp
            <div class="flex flex-wrap gap-2 my-2">
                @foreach ($table_no as $table)
                    @foreach ($tables as $tab)
                        @if ($table == $tab['id'])
                            <p class="p-2 rounded-full border w-max border-amber-500">{{ $tab['name'] }}
                            </p>
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
        <div class="flex items-center gap-2">
            <p class="font-bold">Qty.</p>
            <p class="font-bold px-3 py-1 bg-amber-200 rounded-lg">{{ $var->qty }}</p>
            <span class="text-gray-500">{{ date('M jS, Y h:i:s', strtotime($var->created_at)) }}</span>
        </div>
    </div>
</div>

<div class="flex gap-2 items-center relative">
    <div class="w-10 h-10 rounded-lg bg-gray-300 flex justify-center items-center self-start">
        {{ $var->items->id }}
    </div>
    <div class="grid grid-cols-1 border-separate gap-2">
        <div class="flex flex-col">
            <p class="font-bold">Order #{{ $var->order_id }}</p>
            <p class="">{{ $var->items->name }}</p>
        </div>
        <div class="flex items-center gap-2">
            <p class="font-bold">Qty.</p>
            <p class="font-normal px-3 py-1 bg-amber-200 rounded-lg">{{ $var->qty }}</p>
        </div>
    </div>
</div>
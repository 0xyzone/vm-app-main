<x-layout class="px-4">
    {{-- Main body --}}
    <div class="w-full border-2 rounded-lg py-4 px-8">
        {{-- top layer with customer name and created date and edit buttons --}}
        <div class="flex justify-between items-center border-b-gray-200/10 border-b pb-2">
            <div class="flex flex-col gap-2">

                <h1 class="text-xl lg:text-4xl font-bold text-gray-200">{{ $customer->name }}</h1>
                <p class="font-thin text-xs text-gray-400">
                    Customer ID: <span class="text-amber-500">{{ $customer->id }}</span> • Created at <span
                        class="text-amber-500">{{ $customer->created_at }}</span>
                </p>
            </div>
            @if (auth()->user()->role == 'Admin')
                <div class="flex gap-4 text-white text-2xl">
                    <a href="/customers/{{ $customer->id }}/edit">
                        <i class="fa-solid fa-edit hover:text-amber-600 hover:font-bold smooth"></i>
                    </a>
                    <form method="POST" action="/customers/{{ $customer->id }}/delete">
                        @csrf
                        @method('DELETE')
                        <button class="" onclick="return confirm('Are you sure you want to delete this item?')">
                            <i class="fa-solid fa-trash smooth hover:text-rose-600"></i>
                        </button>
                    </form>
                </div>
            @endif
        </div>
        {{-- Additional Infos --}}
        @php
            $count = $visits->where('customer_id', $customer['id'])->count();
            $details = [
                [
                    'name' => "{$customer['email']}",
                    'icon' => 'fa-duotone fa-envelope',
                ],
                [
                    'name' => "{$customer['phone']}",
                    'icon' => 'fa-duotone fa-phone',
                ],
                [
                    'name' => "{$customer['dob']}",
                    'icon' => 'fa-duotone fa-cake-candles',
                ],
                [
                    'name' => "{$customer['marriage']}",
                    'icon' => 'fa-duotone fa-people',
                ],
                [
                    'name' => "{$customer['marriagedate']}",
                    'icon' => 'fa-duotone fa-calendar',
                ],
                [
                    'name' => "{$count} visits",
                    'icon' => 'fa-duotone fa-door-open',
                ],
                [
                    'name' => "{$customer['gender']}",
                    'icon' => 'fa-duotone fa-venus-mars',
                ],
            ];
        @endphp

        <div class="grid grid-cols-2 md:grid-cols-3 text-white font-thin mt-2 gap-4">
            @foreach ($details as $detail)
                @if ($detail['name'] == '')
                    @continue
                @endif
                <div><i class="{{ $detail['icon'] }} vm-theme"></i><span class="ml-2"> {{ $detail['name'] }}</span>
                </div>
            @endforeach
            <div><i class="fa-duotone fa-map-location-dot vm-theme"></i><span class="ml-2"> {{ $customer['street'] }},
                    {{ $customer['city'] }}, {{ $customer['country'] }} </span></div>

        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="w-full pr-2">
            <h1 class="text-white font-bold text-2xl mt-6">Latest Visits</h1>
            <table class="mt-4 w-full">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal w-full font-bold">
                        <td class="tabledata">S.No.</td>
                        <td class="tabledata">Date</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visits as $visit)
                        <tr class="hover:bg-gray-200 odd:bg-gray-100 even:bg-gray-300 cursor-pointer">
                            <td class="user-td">{{ $loop->iteration }}</td>
                            <td class="user-td">{{ $visit->created_at->format('jS M Y | g : i a') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $visits->appends(['orders' => $orders->currentPage()])->links() }}
            </div>
        </div>
        <div class="w-full pl-2">
            <h1 class="text-white font-bold text-2xl mt-6">Latest Orders</h1>
            <table class="mt-4 w-full">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal w-full font-bold">
                        <td class="tabledata">Order Id</td>
                        <td class="tabledata">Status</td>
                        <td class="tabledata">Date</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="hover:bg-gray-200 odd:bg-gray-100 even:bg-gray-300 cursor-pointer">
                            <td class="user-td">{{ $order->id }}</td>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $orders->appends(['visits' => $visits->currentPage()])->links() }}
            </div>
        </div>
    </div>
</x-layout>

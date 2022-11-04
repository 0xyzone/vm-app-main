<x-layout>
    {{-- Main body --}}
    <div class="w-full border-2 rounded-lg py-4 px-8">
        {{-- top layer with customer name and created date and edit buttons --}}
        <div class="flex justify-between items-center border-b-gray-200/10 border-b pb-2">
            <div class="flex flex-col gap-2">
                <h1 class="text-xl lg:text-4xl font-bold text-gray-200">{{ $customer->name }}</h1>
                <p class="font-thin text-xs text-gray-400">Created at
                    <span class="text-amber-500">{{ $customer->created_at }}</span>
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
                    'name' => "{$customer['visit']}",
                    'icon' => 'fa-duotone fa-door-open',
                ],
            ];
        @endphp

        <div class="grid grid-cols-2 md:grid-cols-3 text-white font-thin mt-2 gap-4">
            @foreach ($details as $detail)
                <div><i class="{{$detail['icon']}} vm-theme"></i><span class="ml-2"> {{$detail['name']}}</span></div>
            @endforeach
            <div><i class="fa-duotone fa-map-location-dot vm-theme"></i><span class="ml-2"> {{$customer['street']}}, {{$customer['city']}}, {{$customer['country']}} </span></div>

        </div>
    </div>
</x-layout>

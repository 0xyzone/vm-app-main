{{-- Menu Items --}}
@php
$menuItems = [
    [
        'name' => 'Dashboard',
        'path' => 'dashboard',
        'icon_class' => 'fa-regular fa-house',
    ],
    [
        'name' => 'Users',
        'path' => 'umgmt',
        'icon_class' => 'fa-regular fa-user-cog',
    ],
    [
        'name' => 'Inventory',
        'path' => 'imgmt',
        'icon_class' => 'fa-solid fa-box-circle-check',
    ],
    [
        'name' => 'Finance',
        'path' => 'finance',
        'icon_class' => 'fa-regular fa-cash-register',
    ],
    [
        'name' => 'Customers',
        'path' => 'customers',
        'icon_class' => 'fa-duotone fa-users',
    ],
    [
        'name' => 'Kitchen',
        'path' => 'kitchen',
        'icon_class' => 'fa-duotone fa-burger-soda',
    ],
    [
        'name' => 'Bar',
        'path' => 'bar',
        'icon_class' => 'fa-duotone fa-martini-glass-citrus',
    ],
    [
        'name' => 'Orders',
        'path' => 'orders',
        'icon_class' => 'fa-duotone fa-clipboard-list',
    ],
    [
        'name' => 'Tables',
        'path' => 'tables',
        'icon_class' => 'fa-duotone fa-loveseat',
    ],
];

@endphp
{{-- Menu Items End --}}
<div class="flex flex-col gap-2">
    @foreach ($menuItems as $item)

        <a class="w-full text-white items-center flex gap-4 hover:bg-amber-600 rounded-lg px-5 py-2.5 smooth text-2xl @if (Request::path() == $item['path']) bg-amber-600 @else bg-gray-800 @endif"
            @if (Request::path() == $item['path']) @else href="/{{ $item['path'] }}" @endif>
            <i class="w-10 text-center {{ $item['icon_class'] }}"></i>
            <span class="text-lg font-normal">{{ $item['name'] }}</span>
        </a>
    @endforeach
</div>
<div class="text-center w-full md:hidden block mt-5">
    <button @click="openModal" id="lgbtn"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>

    <script>
        $('#lgbtn').click(function() {
            console.log('btn clicked');
            $('#modal').removeClass('hidden');
            $('#modalbg').removeClass('hidden');
            $('#modalbg').addClass('flex');
        });
    </script>
</div>

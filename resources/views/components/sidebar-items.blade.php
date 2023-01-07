{{-- Menu Items --}}
@php
    $menuItems = [
        // [
        //     'name' => 'Dashboard',
        //     'path' => 'dashboard',
        //     'icon_class' => 'fa-duotone fa-house',
        // ],
        [
            'name' => 'Users',
            'path' => 'users',
            'icon_class' => 'fa-duotone fa-user-cog',
        ],
        [
            'name' => 'Customers',
            'path' => 'customers',
            'icon_class' => 'fa-duotone fa-users',
        ],
        [
            'name' => 'Inventory',
            'path' => 'inventory',
            'icon_class' => 'fa-duotone fa-box-circle-check',
        ],
        [
            'name' => 'Tables',
            'path' => 'tables',
            'icon_class' => 'fa-duotone fa-loveseat',
        ],
        [
            'name' => 'Orders',
            'path' => 'orders',
            'icon_class' => 'fa-duotone fa-clipboard-list',
        ],
        [
            'name' => 'Invoices',
            'path' => 'invoices',
            'icon_class' => 'fa-duotone fa-file-invoice-dollar',
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
            'name' => 'Reports',
            'path' => 'reports',
            'icon_class' => 'fa-duotone fa-clipboard',
        ],
    ];
    
@endphp
{{-- Menu Items End --}}
<div class="flex flex-col gap-2">
    @php
        $role = auth()->user()->role;
    @endphp

    @foreach ($menuItems as $item)
        @php
            $name = $item['name'];
        @endphp
        @if ($role == 'BarMaster' && $name == 'Bar')
            @include('inc.menubutton')
        @elseif ($role == 'KitchenMaster' && $name == 'Kitchen')
            @include('inc.menubutton')
        @elseif ($role == 'Cashier' && ($name == 'Tables' || $name == 'Invoices' || $name == 'Customers'))
            @include('inc.menubutton')
        @elseif ($role == 'Cook' && $name == 'Kitchen')
            @include('inc.menubutton')
        @elseif ($role == 'Waiter' && ($name == 'Tables' || $name == 'Orders' || $name == 'Customers'))
            @include('inc.menubutton')
        @elseif ($role == 'Admin')
            @include('inc.menubutton')
        @else
        @endif
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

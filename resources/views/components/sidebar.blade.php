@if (Request::path() == 'login')
@else
    <div class="flex flex-col bg-gray-300 absolute z-40 h-full" x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
        @keydown.escape="closeSideMenu">
        <div class="w-full flex text-lg justify-center mt-8 pb-8 md:hidden shadow-lg ">
            <a href="/" class="w-32"><img src="{{ asset('img/logo.png') }}" alt="logo"></a>
        </div>
        <div
            class="z-20 w-64 md:hidden flex flex-col h-full p-4 overflow-y-auto sacrollbar">
            <x-sidebar-items />
        </div>
    </div>
    <div class="md:flex flex-col bg-gray-300 hidden">
        <div class="w-full md:flex text-lg justify-center mt-8 hidden shadow-lg pb-8">
            <a href="/" class="w-32"><img src="{{ asset('img/logo.png') }}" alt="logo"></a>
        </div>
        <aside class="z-20 w-72 hidden md:flex flex-col h-full p-4 overflow-y-auto sacrollbar">
            <x-sidebar-items />
        </aside>
    </div>
@endif

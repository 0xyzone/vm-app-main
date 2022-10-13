@if (\Request::path() == ("register"))
@elseif(\Request::path() == ("login"))
@else
<header class="z-20 py-4 shadow-md bg-gray-900 sticky top-0">
    <div class="container flex items-center justify-between md:justify-end h-full px-6 mx-auto text-white">
        <!-- Mobile hamburger -->
        <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-lime"
            @click="toggleSideMenu" aria-label="Menu">
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
        
        <span id='ct7' class="mr-2"></span>
        <ul class="flex items-center flex-shrink-0 space-x-6">
            <!-- Notifications menu -->
            <li class="relative">
                <button class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-lime"
                    @click="toggleNotificationsMenu" @keydown.escape="closeNotificationsMenu" aria-label="Notifications"
                    aria-haspopup="true">
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
                        </path>
                    </svg>
                    <!-- Notification badge -->
                    <span aria-hidden="true"
                        class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 rounded-full border-stone-800"></span>
                </button>
                <template x-if="isNotificationsMenuOpen">
                    <ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0" @click.away="closeNotificationsMenu"
                        @keydown.escape="closeNotificationsMenu"
                        class="absolute right-0 w-56 p-2 mt-2 space-y-2 border rounded-md shadow-md text-stone-300 border-stone-700 bg-stone-700">
                        <li class="flex">
                            <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-stone-800 hover:text-stone-200"
                                href="#">
                                <span>Messages</span>
                                <span
                                    class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none rounded-full text-red-100 bg-red-600">
                                    13
                                </span>
                            </a>
                        </li>
                </template>
            </li>
        </ul>
    </div>
</header>
@endif
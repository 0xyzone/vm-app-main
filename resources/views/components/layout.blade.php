<!DOCTYPE html>
<html lang="en" x-data="data()">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon"> 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="{{ asset('js/init-alpine.js') }}"></script>
    <script src="{{ asset('js/focus-trap.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <title>
        @hasSection('title')
            @yield('title') | Vishudda Momocha
        @else
            Vishudda Momocha
        @endif
    </title>
    <script type="text/javascript">
        function display_ct7() {
            var x = new Date()
            var ampm = x.getHours() >= 12 ? ' PM' : ' AM';
            hours = x.getHours() % 12;
            hours = hours ? hours : 12;
            hours = hours.toString().length == 1 ? 0 + hours.toString() : hours;

            var minutes = x.getMinutes().toString()
            minutes = minutes.length == 1 ? 0 + minutes : minutes;

            var seconds = x.getSeconds().toString()
            seconds = seconds.length == 1 ? 0 + seconds : seconds;

            var dt = x.getDate().toString();
            dt = dt.length == 1 ? 0 + dt : dt;

            var x1 = x.toLocaleString('default', {
                month: 'short'
            }) + " " + dt + ", " + x.getFullYear();
            x1 = x1 + " | " + hours + ":" + minutes + ":" + seconds + " " + ampm;
            $('#ct7').html(x1);
            display_c7();
        }

        function display_c7() {
            var refresh = 1000; // Refresh rate in milli seconds
            mytime = setTimeout('display_ct7()', refresh)
        }
        display_c7()
    </script>
</head>
<body class="w-screen relative font-light lg:font-normal z-0 smooth sacroll overflow-hidden @if(Request::path() == "login") bg-gray-300 @else bg-gray-800 @endif" onload='display_ct7();'>

    <x-flash-error />

    <x-flash-success />

    <div class="flex h-screen" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <x-sidebar />
        <div class="flex flex-col flex-1 w-full overflow-x-hidden sacrollbar">
            <x-header />
            <x-container {{$attributes->merge(['class' => 'pt-10 lg:px-10'])}}>

                {{ $slot }}

            </x-container>
        </div>
    </div>

    <!-- Modal backdrop. This what you want to place close to the closing body tag -->
    <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-40 items-end bg-black bg-opacity-50 sm:items-center sm:justify-center hidden"
        id="modalbg">
        <!-- Modal -->
        <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="closeModal"
            @keydown.escape="closeModal"
            class="w-full px-6 py-4 overflow-hidden rounded-t-lg bg-gray-800 rounded-lg m-4 max-w-xl hidden"
            role="dialog" id="modal">
            <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
            <header class="flex justify-end">
                <button
                    class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded hover:text-gray-200 "
                    aria-label="close" @click="closeModal">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                        <path
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg>
                </button>
            </header>
            <!-- Modal body -->
            <div class="mt-4 mb-6">
                <!-- Modal title -->
                <p class="mb-2 text-lg font-semibold text-gray-300">
                    Logging Out?
                </p>
                <!-- Modal description -->
                <p class="text-sm text-gray-400">
                    Do you really want to log out?
                </p>
            </div>
            <footer
                class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-800">
                <button @click="closeModal"
                    class="w-full px-5 py-3 text-sm font-medium leading-5 transition-colors duration-150 border border-gray-300 rounded-lg text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                    Cancel
                </button>
                <form action="/logout" method="POST" id="logout" class="w-full">
                    @csrf
                    <button
                        class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-amber-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-amber-600 hover:bg-amber-700 focus:outline-none focus:shadow-outline-lime">
                        Log Out
                    </button>
                </form>
            </footer>
        </div>
    </div>
    <!-- End of modal backdrop -->
    
</body>

</html>

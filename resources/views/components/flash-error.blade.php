@if (session()->has('error'))
    <div class="hidden lg:block absolute z-20 w-max py-2 px-4 lg:bottom-8 bottom-16 lg:right-8 bg-rose-200 text-rose-800 border border-current fadeInLeft text-xl shadow-main rounded"
        id="error">
        {{ session('error') }}
    </div>
    <div class="flex justify-center w-full">
        <div class="lg:hidden absolute z-20 w-max py-2 px-4 top-2 bg-lime-200 text-lime-800 border border-current fadeInTop text-xl shadow-main rounded fadeOut"
            id="error2">
            <p>{{ session('error') }}</p>
        </div>
    </div>
    <script>
        setTimeout(function() {
            $('#error').fadeOut('slow');
        }, 3000); // <-- time in milliseconds
        setTimeout(function() {
            $('#error2').fadeOut('slow');
        }, 3000); // <-- time in milliseconds
    </script>
@endif
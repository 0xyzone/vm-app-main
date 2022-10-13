@if (session()->has('success'))
    <div class="hidden lg:block fixed z-20 w-max py-2 px-4 lg:bottom-8 bottom-16 lg:right-8 bg-lime-200 text-lime-800 border border-current fadeInLeft text-xl shadow-main rounded"
        id="success">
        {{ session('success') }}
    </div>
    <div class="flex justify-center w-full">
        <div class="lg:hidden fixed z-20 w-max py-2 px-4 top-2 bg-lime-200 text-lime-800 border border-current fadeInTop text-xl shadow-main rounded fadeOut"
            id="success2">
            <p>{{ session('success') }}</p>
        </div>
    </div>
    <script>
        setTimeout(function() {
            $('#success').fadeOut('slow');
        }, 3000); // <-- time in milliseconds
        setTimeout(function() {
            $('#success2').fadeOut('slow');
        }, 3000); // <-- time in milliseconds
    </script>
@endif

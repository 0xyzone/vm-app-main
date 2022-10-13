<x-layout>
<body class="w-screen h-screen relative font-light lg:font-normal z-0 bg-gray-300" >
  <div class="p-10 max-w-lg mx-auto ">
    <div class=" flex text-white text-lg w-full justify-center mb-4">
        <img src="img/logo.png" alt="logo" class="w-40">
    </div>
    <header class="text-center">
      <h2 class="text-2xl font-bold text-gray-800 uppercase mb-1">
          Login
      </h2>
  </header>
    {{-- Login form --}}
    <form method="POST" action="/users " class=" rounded-lg border border-black bg-gray-800 p-10">
      @csrf
        <div class="mb-6">
            <label for="email" class="inline-block text-white text-lg mb-2"
                >Email</label
            >
            <input
                type="email"
                class="border border-gray-200 rounded p-2 w-full"
                name="email"
                value="{{old('email')}}"
            />
            @error('email')
            <p class="text-white text-xs mt-1">{{$message}}</p>
            @enderror
            <!-- Error Example -->
           
        </div>
  
        <div class="mb-6">
            <label
                for="password"
                class="inline-block text-white text-lg mb-2"
            >
                Password
            </label>
            <input
                type="password"
                class="border border-gray-200 rounded p-2 w-full"
                name="password"
                value="{{old('password')}}"
            />
            @error('password')
            <p class="text-white text-xs mt-1">{{$message}}</p>
            @enderror
        </div>
  
        <div class="mb-6">
            <button
            href="/"
                type="submit"
                class="bg-laravel text-white border border-sky-200 rounded py-2 px-4 hover:bg-black"
            >
                Sign In
            </button>
        </div>

        <div class="mt-8 text-white">
            <p>
                Don't have an account?
                <a href="/register" class="text-white"
                    >Register </a
                >
            </p>
        </div>
    </form>
    {{-- login end --}}
  </div>
</x-layout>
<!DOCTYPE html>
<html lang="en" x-data="data()">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
</head>
<body class="w-screen h-screen relative font-light lg:font-normal z-0 bg-gray-300" >
  <div class="p-10 max-w-lg mx-auto ">
    <div class=" flex text-white text-lg w-full justify-center mb-4">
   <img src="img/logo.png" alt="logo" class="w-40">
    </div>
    <header class="text-center">
      <h2 class="text-2xl font-bold text-gray-800 uppercase mb-1">
          Register
      </h2>
  </header>

  <form method="POST" action="/users" class=" rounded-lg border border-black bg-gray-800 p-10">
    @csrf
      <div class="mb-6">
          <label for="name" class="inline-block text-white text-lg mb-2">
              Name
          </label>
          <input
              type="text"
              class="border border-gray-200 rounded p-2 w-full"
              name="name"
              value="{{old('name')}}"
          />
          @error('name')
          <p class="text-white text-xs mt-1">{{$message}}</p>
          @enderror
      </div>

      <div class="mb-6">
        <label for="username" class="inline-block text-white text-lg mb-2">
            Username
        </label>
        <input
            type="text"
            class="border border-gray-200 rounded p-2 w-full"
            name="username"
            value="{{old('uername')}}"
        />
        @error('username')
        <p class="text-white text-xs mt-1">{{$message}}</p>
        @enderror
    </div>

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
          <label
              for="password2"
              class="inline-block text-white text-lg mb-2"
          >
              Confirm Password
          </label>
          <input
              type="password"
              class="border border-gray-200 rounded p-2 w-full"
              name="password_confirmation"
              value="{{old('password_confirmation')}}"
          />
          @error('password_confirmation')
          <p class="text-white text-xs mt-1">{{$message}}</p>
          @enderror
      </div>

      <div class="mb-6">
        <label for="phone" class="inline-block text-white text-lg mb-2">
            Phone No
        </label>
        <input
            type="text"
            class="border border-gray-200 rounded p-2 w-full"
            name="phone"
            value="{{old('phone')}}"
        />
        @error('phone')
        <p class="text-white text-xs mt-1">{{$message}}</p>
        @enderror
    </div>

    <div class="mb-6">
      <label for="role" class="inline-block text-white text-lg mb-2">
          Role
      </label>
      <input
          type="text"
          class="border border-gray-200 rounded p-2 w-full"
          name="role"
          value="{{old('role')}}"
      />
      @error('role')
      <p class="text-white text-xs mt-1">{{$message}}</p>
      @enderror
  </div>

      <div class="mb-6">
          <button
              type="submit"
              class="text-white  border border-sky-200 rounded py-2 px-4 hover:bg-black"
          >
              Sign Up
          </button>
      </div>

      <div class="mt-8 text-white">
          <p>
              Already have an account?
              <a href="/login" class=""
                  >Login</a
              >
          </p>
          
      </div>
  </form>
  
</body>
</html>
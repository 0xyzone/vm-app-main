<x-layout>

    <div class="px-10 max-w-lg mx-auto ">
        <div class=" flex text-white text-lg w-full justify-center">
            <img src="img/logo.png" alt="logo" class="w-40">
        </div>

        <h2 class="text-2xl font-bold text-gray-800 uppercase text-center my-10">
            Register
        </h2>

        <form method="POST" action="/users" class="rounded-lg border border-black bg-gray-800 p-10" id="signup">
            @csrf
            <div class="mb-6">
                <label for="name" class="inline-block text-white text-lg mb-2">
                    Name
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                    value="{{ old('name') }}" />
                @error('name')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="username" class="inline-block text-white text-lg mb-2">
                    Username
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="username"
                    value="{{ old('uername') }}" />
                @error('username')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="inline-block text-white text-lg mb-2">Email</label>
                <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email"
                    value="{{ old('email') }}" />
                @error('email')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror

            </div>

            <div class="mb-6">
                <label for="password" class="inline-block text-white text-lg mb-2">
                    Password
                </label>
                <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password"
                    value="{{ old('password') }}" />
                @error('password')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password2" class="inline-block text-white text-lg mb-2">
                    Confirm Password
                </label>
                <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password_confirmation"
                    value="{{ old('password_confirmation') }}" />
                @error('password_confirmation')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="phone" class="inline-block text-white text-lg mb-2">
                    Phone No
                </label>
                <input type="number" class="border border-gray-200 rounded p-2 w-full" name="phone"
                    value="{{ old('phone') }}" />
                @error('phone')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="role" class="inline-block text-white text-lg mb-2">
                    Role
                </label>
                <select name="role" id="role" class="border border-gray-200 rounded p-2 w-full">
                    <option value="{{ old('role') }}">{{ old('role') }}</option>
                    <option value="Admin">Admin</option>
                    <option value="Cashier">Cashier</option>
                    <option value="BarMaster">BarMaster</option>
                    <option value="Waiter">Waiter</option>
                    <option value="KitchenMaster">KitchenMaster</option>
                </select>
                @error('role')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button for="signup" type="submit"
                    class="text-white  border border-sky-200 rounded py-2 px-4 hover:bg-black">
                    Sign Up
                </button>
            </div>

            <div class="mt-8 text-white">
                <p>
                    Already have an account?
                    <a href="/login" class="">Login</a>
                </p>

            </div>
        </form>
    </div>
</x-layout>

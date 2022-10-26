<x-layout>
    <div class="px-10 max-w-lg mx-auto pb-10 overflow-y-auto overflow-x-hidden">
        <h2 class="text-2xl font-bold text-white uppercase text-center my-5">
            Register
        </h2>

        <form method="POST" action="/users/store"
            class="rounded-xl border-2 border-white bg-gradient-to-t to-gray-50/80 from-gray-500/80 shadow-lg  p-10 mb-10 h-full"
            id="signup">
            @csrf
            <div class="mb-6">
                <label for="name" class="reg-label">
                    Name
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                    value="{{ old('name') }}" autofocus placeholder="John Doe" />
                @error('name')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="username"  class="reg-label">
                    Username 
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="username"
                    value="{{ old('username') }}" placeholder="john" pattern="[a-z0-9]+"/>
                    <p class="text-xs text-gray-900/50 font-light leading-tight py-2">Please use lowercase characters and/or numbers for username.</p>
                @error('username')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="reg-label">Email</label>
                <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email"
                    value="{{ old('email') }}" placeholder="example@example.com" />
                @error('email')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror

            </div>

            <div class="mb-6">
                <label for="password" class="reg-label">
                    Password
                </label>
                <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password"
                    value="{{ old('password') }}" />
                @error('password')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password2" class="reg-label">
                    Confirm Password
                </label>
                <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password_confirmation"
                    value="{{ old('password_confirmation') }}" />
                @error('password_confirmation')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="phone" class="reg-label"></label>
                    Phone No
                </label>
                <input type="number" class="border border-gray-200 rounded p-2 w-full" name="phone"
                    value="{{ old('phone') }}" placeholder="9812345678"/>
                @error('phone')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="role" class="reg-label">
                    Role
                </label>
                <select name="role" id="role" class="border border-gray-200 rounded p-2 w-full">
                    @php
                    $roles = [
                        [
                            "name" => "Admin",
                        ],
                        [
                            "name" => "Cashier",
                        ],
                        [
                            "name" => "BarMaster",
                        ],
                        [
                            "name" => "Waiter",
                        ],
                        [
                            "name" => "KitchenMaster",
                        ],
                        [
                            "name" => "Cook",
                        ],
                    ]
                    @endphp

                    <option value="" disabled selected hidden >Please Choose an option.</option>
                    @foreach($roles as $role)
                    <option value="{{ $role['name'] }}" @if(old('role') === $role['name'] ) selected @else @endif>{{ $role['name'] }}</option>
                    @endforeach
                </select>
                @error('role')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button for="signup" type="submit"
                    class="text-white  border border-sky-200 rounded py-2 px-4 hover:bg-black">
                    Create
                </button>
            </div>
        </form>
    </div>
</x-layout>

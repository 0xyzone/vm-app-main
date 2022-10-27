<x-layout>
    <div class="px-10 max-w-lg mx-auto pb-10 overflow-y-auto overflow-x-hidden">
        <h2 class="text-2xl font-bold text-white uppercase text-center my-5">
            Edit customer
        </h2>
        <form method="POST" action="/customers/{{$customer->id}}/update"
            class="rounded-xl border-2 border-white bg-gradient-to-t to-gray-50/80 from-gray-500/80 shadow-lg  p-10 mb-10 h-full"
            id="signup">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="name" class="reg-label">
                    Name
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                    value="{{ $customer->name }}" placeholder="John Doe" />
                @error('name')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="reg-label">Email</label>
                <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email"
                    value="{{ $customer->email }}" placeholder="example@example.com" />
                @error('email')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="phone" class="reg-label"></label>
                Phone No
                </label>
                <input type="number" class="border border-gray-200 rounded p-2 w-full" name="phone"
                    value="{{ $customer->phone }}" placeholder="9812345678" />
                @error('phone')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <p class="font-light text-2xl">Address</p>
                <label for="street" class="reg-label">
                    Street
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="street"
                    value="{{ $customer->street }}" placeholder="Sorakhutte" />
                @error('street')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror

                <label for="city" class="reg-label mt-2">
                    City
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="city"
                    value="{{ $customer->city }}" placeholder="Kathmandu" />
                @error('city')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror

                <label for="country" class="reg-label mt-2">
                    Country
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="country"
                    value="{{ $customer->country }}" placeholder="Sorakhutte" />
                @error('country')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <p class="font-light text-2xl">Lotalty</p>
                <label for="visit" class="reg-label mt-2">
                    Visits
                </label>
                <input type="number" class="border border-gray-200 rounded p-2 w-full" name="visit"
                    value="{{ $customer->visit }}" placeholder="1" />
                @error('visit')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button for="signup" type="submit"
                    class="text-white  border border-sky-200 rounded py-2 px-4 hover:bg-black">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-layout>
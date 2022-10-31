<x-layout>
    <div class="px-10 max-w-lg mx-auto pb-10 overflow-y-auto overflow-x-hidden">
        <h2 class="text-2xl font-bold text-white uppercase text-center my-5">
            Add new customer
        </h2>
        <form method="POST" action="/customers/store"
            class="rounded-xl border-2 border-white bg-gradient-to-t to-gray-50/80 from-gray-500/80 shadow-lg  p-10 mb-10 h-full"
            id="signup">
            @csrf
            {{-- Name --}}
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

            {{-- Email --}}
            <div class="mb-6">
                <label for="email" class="reg-label">Email</label>
                <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email"
                    value="{{ old('email') }}" placeholder="example@example.com" />
                @error('email')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Phone No. --}}
            <div class="mb-6">
                <label for="phone" class="reg-label"></label>
                Phone No
                </label>
                <input type="number" class="border border-gray-200 rounded p-2 w-full" name="phone"
                    value="{{ old('phone') }}" placeholder="9812345678" />
                @error('phone')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Address start --}}
            <div class="mb-6">
                <p class="font-light text-2xl">Address</p>
                <label for="street" class="reg-label">
                    Street
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="street"
                    value="{{ old('street') }}" placeholder="Sorakhutte" />
                @error('street')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror

                <label for="city" class="reg-label mt-2">
                    City
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="city"
                    value="{{ old('city') }}" placeholder="Kathmandu" />
                @error('city')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror

                <label for="country" class="reg-label mt-2">
                    Country
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="country"
                    value="{{ old('country') }}" placeholder="Sorakhutte" />
                @error('country')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Details start --}}
            <div class="mb-6">
                <p class="font-light text-2xl">Details</p>
                <label for="dob" class="reg-label">
                    Date Of Birth
                </label>
                <input type="date" class="border border-gray-200 rounded p-2 w-full" name="dob"
                    value="{{ old('dob') }}" />
                @error('dob')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror

                <label for="marriage" class="reg-label mt-2">
                    Marriage Status
                </label>
                <select name="marriage" id="marriage" class="border border-gray-200 rounded p-2 w-full">
                    @php
                        $marrriages = [
                            [
                                'name' => 'Married',
                            ],
                            [
                                'name' => 'Single',
                            ],
                        ];
                    @endphp
                    <option value="" disabled selected hidden>Please Choose an option.</option>
                    @foreach ($marrriages as $marriage)
                        <option value="{{ $marriage['name'] }}"
                            @if (old('marriage') === $marriage['name']) selected @else @endif>{{ $marriage['name'] }}</option>
                    @endforeach
                </select>
                @error('marriage')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror

                <label for="marriagedate" class="reg-label mt-2">
                    Date Of Marriage
                </label>
                <input type="date" class="border border-gray-200 rounded p-2 w-full" name="marriagedate"
                    value="{{ old('marriagedate') }}" />
                @error('marriagedate')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <input type="number" class="border border-gray-200 rounded p-2 w-full" name="visit" value="1"
                placeholder="1" hidden />

            <div class="mb-6">
                <button for="signup" type="submit"
                    class="text-white  border border-sky-200 rounded py-2 px-4 mt-4 hover:bg-black">
                    Create
                </button>
            </div>


        </form>
    </div>
</x-layout>

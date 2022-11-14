<x-layout>
    <div class="px-10 pb-10 overflow-y-auto overflow-x-hidden">
        <h2 class="text-2xl font-bold text-amber-400 uppercase text-center my-5">
            Edit customer
        </h2>
        <form method="POST" action="/customers/{{$customer->id}}/update"
            class="rounded-xl border-2 border-white bg-transparent shadow-lg  p-10 mb-10 h-full w-full" id="signup">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 lg:grid-cols-3 h-max">
                <div class="lg:pr-10">
                    <p class="font-light text-4xl text-white pb-2">Details</p>
                    {{-- Name --}}
                    <div class="mb-6">
                        <label for="name" class="reg-label">
                            Name
                        </label>
                        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                            value="{{ $customer->name }}" />
                        @error('name')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-6">
                        <label for="email" class="reg-label">Email</label>
                        <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email"
                            value="{{ $customer->email }}"/>
                        @error('email')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Phone No. --}}
                    <div class="mb-6">
                        <label for="phone" class="reg-label">
                            Phone No
                        </label>
                        <input type="number" class="border border-gray-200 rounded p-2 w-full" name="phone"
                            value="{{ $customer->phone }}"/>
                        @error('phone')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                {{-- Address start --}}
                <div class="mb-6 lg:border-l-2 border-t-2 pt-2 lg:border-t-0 lg:pt-0 lg:px-10 border-dotted h-full">
                    <p class="font-light text-4xl text-white pb-2">Address</p>
                    <label for="street" class="reg-label">
                        Street
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="street"
                        value="{{ $customer->street }}"/>
                    @error('street')
                        <p class="error-text">{{ $message }}</p>
                    @enderror

                    <label for="city" class="reg-label mt-2">
                        City
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="city"
                        value="{{ $customer->city }}"/>
                    @error('city')
                        <p class="error-text">{{ $message }}</p>
                    @enderror

                    <label for="country" class="reg-label mt-2">
                        Country
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="country"
                        value="{{ $customer->country }}"/>
                    @error('country')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Details start --}}
                <div class="mmb-6 lg:border-l-2 border-t-2 pt-2 lg:border-t-0 lg:pt-0 lg:px-10 border-dotted h-full">
                    <p class="font-light text-4xl text-white pb-2">Additional Details</p>
                    <label for="dob" class="reg-label">
                        Date Of Birth
                    </label>
                    <input type="date" class="border border-gray-200 rounded p-2 w-full" name="dob"
                        value="{{ $customer->dob }}" />
                    @error('dob')
                        <p class="error-text">{{ $message }}</p>
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
                                @if ($customer->marriage === $marriage['name']) selected @else @endif>{{ $marriage['name'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('marriage')
                        <p class="error-text">{{ $message }}</p>
                    @enderror

                    <label for="marriagedate" class="reg-label mt-2">
                        Date Of Marriage
                    </label>
                    <input type="date" class="border border-gray-200 rounded p-2 w-full" name="marriagedate"
                        value="{{ old('marriagedate') }}" />
                    @error('marriagedate')
                        <p class="error-text">{{ $message }}</p>
                    @enderror

                    <label for="gender" class="reg-label mt-2">
                        Gender
                    </label>
                    <select name="gender" id="gender" class="border border-gray-200 rounded p-2 w-full">
                        @php
                            $genders = [
                                [
                                    'name' => 'Male',
                                ],
                                [
                                    'name' => 'Female',
                                ],
                                [
                                    'name' => 'Others',
                                ],
                            ];
                        @endphp
                        <option value="" disabled selected hidden>Please Choose an option.</option>
                        @foreach ($genders as $gender)
                            <option value="{{ $gender['name'] }}"
                                @if ($customer->gender === $gender['name']) selected @else @endif>
                                {{ $gender['name'] }}</option>
                        @endforeach
                    </select>
                    @error('gender')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6 mt-6">
                <button for="signup" type="submit" class="btn-primary">
                    Update
                </button>
            </div>


        </form>
    </div>
</x-layout>

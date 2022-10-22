<x-layout>
    <div class="flex flex-col w-full h-max items-center gap-5">
        <div class="flex justify-between 2xl:w-6/12 w-full">
            <a href="{{ url()->previous() }}" class="text-white"><i class="fa-solid fa-arrow-left"></i> Back</a>
            <label for="tables" class="font-bold text-amber-600 text-xl">
                Add Table
            </label>
        </div>
        <form method='POST' action='/tables/store'
            class="w-full 2xl:w-6/12 rounded-xl border-2 border-white bg-transparent shadow-lg p-10 mb-10 mt-3 h-full"
            id="submit">
            @csrf
            <div class="mb-6">
                <label for="name">
                    Name
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                    value="{{ old('name') }}" autofocus placeholder="Table No." />
                @error('name')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="type">
                    Availability
                </label>
                <select name="availability" id="type" class="border border-gray-200 rounded p-2 w-full">
                    @php
                        $availability = [
                            [
                                'name' => 'Available',
                            ],
                            [
                                'name' => 'Reserved',
                            ],
                            [
                                'name' => 'Occupied',
                            ],
                        ];
                    @endphp

                    <option value="" disabled selected hidden>Please Choose an option.</option>
                    @foreach ($availability as $avail)
                        <option value="{{ $avail['name'] }}" @if (old('type') === $avail['name']) selected @else @endif>
                            {{ $avail['name'] }}</option>
                    @endforeach
                </select>
                @error('availability')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="type">
                    Floor
                </label>
                <select name="floor" id="type" class="border border-gray-200 rounded p-2 w-full">
                    @php
                        $floors = [
                            [
                                'name' => 'First',
                            ],
                            [
                                'name' => 'Second',
                            ],
                            [
                                'name' => 'Third',
                            ],
                        ];
                    @endphp

                    <option value="" disabled selected hidden>Please Choose an option.</option>
                    @foreach ($floors as $floor)
                        <option value="{{ $floor['name'] }}" @if (old('type') === $floor['name']) selected @else @endif>
                            {{ $floor['name'] }}</option>
                    @endforeach
                </select>
                @error('floor')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button type="submit" class="text-white border border-sky-200 rounded py-2 px-4 hover:bg-black">
                    Add
                </button>
            </div>
        </form>
    </div>
</x-layout>

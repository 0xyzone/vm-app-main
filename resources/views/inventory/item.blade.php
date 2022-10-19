<x-layout>
    <a href="{{ url()->previous() }}" class="text-white"><i class="fa-solid fa-arrow-left"></i> Back</a>
    <div class="m-6 flex flex-col w-max h-max">
        <label for="category" class="font-bold text-amber-600 text-xl">
            Add Item
        </label>
        <form method="POST" action="/item/store"
            class="rounded-xl border-2 border-white bg-transparent shadow-lg p-10 mb-10 mt-3 h-full " id="submit">
            @csrf
            <div class="mb-6">
                <label for="name">
                    Item
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                    value="{{ old('name') }}" autofocus placeholder="Chicken Mo:Mo" />
                @error('item')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="price">
                    Price
                </label>
                <input type="number" class="border border-gray-200 rounded p-2 w-full" name="price"
                    value="{{ old('price') }}" placeholder="500" />
                @error('price')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="unit">
                    Unit
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="unit"
                    value="{{ old('unit') }}" autofocus placeholder="plate" />
                @error('unit')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="category">
                    Category
                </label>
                <select name="category" id="category" class="border border-gray-200 rounded p-2 w-full">
                    <option value="" disabled selected hidden>Please Choose an option.</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category['name'] }}" @if (old('category') === $category['name']) selected @else @endif>
                            {{ $category['name'] }}</option>
                    @endforeach
                </select>
                @error('category')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="image">
                    Item image
                </label>
                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="image" />

                @error('image')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <button type="submit"
                    class="text-white  border border-sky-200 rounded py-2 px-4 hover:bg-black">
                    Add
                </button>
            </div>
        </form>
</x-layout>

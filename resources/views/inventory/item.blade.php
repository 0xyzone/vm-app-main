<x-layout>
    <div class="flex flex-col w-full h-max items-center gap-5">
        <div class="flex justify-between 2xl:w-6/12 w-full">
            <a href="{{ url()->previous() }}" class="text-white"><i class="fa-solid fa-arrow-left"></i> Back</a>
            <label for="category" class="font-bold text-amber-600 text-xl">
                Add Item
            </label>
        </div>
        <form method="POST" action="/item/store" enctype="multipart/form-data"
            class="w-full 2xl:w-6/12 rounded-xl border-2 border-white bg-transparent shadow-lg p-10 mb-10 mt-3 h-full" id="submit">
            @csrf
            <div class="mb-6">
                <label for="name">
                    Name
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                    value="{{ old('name') }}" autofocus placeholder="Chicken Mo:Mo" />
                @error('name')
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
                        <option value="{{ $category['id'] }}" @if (old('category') === $category['id']) selected @else @endif>
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
                <input type="file" class="border border-gray-200 rounded p-2 text-white w-full" name="image" />
                @error('image')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button type="submit" class="text-white  border border-sky-200 rounded py-2 px-4 hover:bg-black">
                    Add
                </button>
            </div>
        </form>
</x-layout>

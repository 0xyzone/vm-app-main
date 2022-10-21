<x-layout>

    <div class="px-10 max-w-lg mx-auto pb-10 overflow-y-auto overflow-x-hidden">
        <h2 class="text-2xl font-bold text-white uppercase text-center my-5">
            Edit item
        </h2>
 
        <form method="POST" action="/item/{{ $item->id }}" enctype="multipart/form-data"
            class="rounded-lg border border-black bg-gray-800 p-10 mb-10 h-full" id="signup">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="name">
                    Name
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                    value="{{ $item->name }}" autofocus placeholder="Chicken Mo:Mo" />
                @error('name')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="price">
                    Price
                </label>
                <input type="number" class="border border-gray-200 rounded p-2 w-full" name="price"
                    value="{{ $item->price }}" placeholder="500" />
                @error('price')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="unit">
                    Unit
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="unit"
                    value="{{ $item->unit }}" autofocus placeholder="plate" />
                @error('unit')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="category">
                    Category
                </label>
                <select name="category" id="category" class="border border-gray-200 rounded p-2 w-full">
                    <option value="{{ $item->category }}" selected hidden>
                        @foreach ($categories as $category)
                            @if ($item->category == $category['id'])
                            {{$category['name']}}
                            @endif
                        @endforeach
                    </option>
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
                <input type="file" class="border border-gray-200 rounded p-2 text-white w-full" name="image"/>
                @error('image')
                    <p class="text-white text-xs mt-1">{{ $message }}</p>
                @enderror
                @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" alt="item image" class="w-32 h-32 rounded-lg mt-4 object-cover">
                @else
                @endif
            </div>

            <div class="mb-6">
                <button type="submit" class="text-white  border border-sky-200 rounded py-2 px-4 hover:bg-black">
                    Update
                </button>
            </div>

        </form>

    </div>
</x-layout>

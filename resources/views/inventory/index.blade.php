<x-layout>
  <div class="mb-6 flex flex-col text-white">
    <label for="category" class=" font-bold">
        Category
    </label>
    <form>
      @csrf
      <div class="mb-6 mt-5 w-64">
        <label for="name" class="">
            Name
        </label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
            value="{{ old('name') }}" autofocus  />
        @error('name')
            <p class="text-white text-xs mt-1">{{ $message }}</p>
        @enderror
    <div class="mt-3">
    <label for="category" class="">
      Category
  </label>
    <select name="category" id="category" class="border border-gray-200 rounded p-2  ">
        @php
        $categories = [
            [
                "name" => "Food",
            ],
            [
                "name" => "Beverage",
            ],
            [
                "name" => "Miscellaneous",
            ],
        ]
        @endphp
        <option value="" disabled selected hidden >Please Choose an option.</option>
        @foreach($categories as $category)
        <option value="{{ $category['name'] }}" @if(old('category') === $category['name'] ) selected @else @endif>{{ $category['name'] }}</option>
        @endforeach
    </select>
  </div>
  </form>
    @error('category')
        <p class="text-white text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
</x-layout>
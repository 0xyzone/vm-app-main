<x-layout>
    <div class="mb-6">
        <label for="item" class="text-white">
            Choose items:
        </label>
        {{-- Search Bar --}}
        <input type="search" name="search" class="border border-gray-200 rounded p-2 w-full my-2"
            placeholder="Search Items..." id="search">
        {{-- end search bar --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-2" id="content_all">
            @foreach ($items as $item)
                <x-card class="flex-col">
                    <!-- <img src="{{ asset('storage/' . $item->image) }}" alt="item image" class="w-32"
                        onerror="this.onerror=null;this.src='{{ asset('img/logo.png') }}';"> -->
                    <div class="p-4 flex flex-col items-center">
                        <p class="text-black  text-center">
                            {{ $item['name'] }}
                        </p>
                        {{ $item['price'] }}
                    </div>
                </x-card>
            @endforeach
        </div>
        <div class="mt-6" id="content_all_links">
            {{ $items->links() }}
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-2" id="content">
        </div>
    </div>
</x-layout>
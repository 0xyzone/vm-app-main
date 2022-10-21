<x-layout>
    <div class="grid grid-cols-1 gap-10 h-32 w-full place-items-center">
        <div class="lg:w-6/12 flex flex-col gap-4">
            <div class="justify-between flex w-full text-xl font-bold text-gray-300 items-center">
                {{-- category --}}
                <p>Categories</p>
                <a href="/ctmgmt" class="btn-primary"> Add Catagory</a>
            </div>

            <table>
                @php
                    $count_categories = $categories->count();
                @endphp
                @if ($count_categories == 0)
                @else
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal w-full">
                            <td class="tabledata">ID</td>
                            <td class="tabledata w-full">Category</td>
                            <td class="tabledata">Type</td>
                            <td class="tabledata">Action</td>
                        </tr>
                    </thead>
                @endif
                <tbody>
                    @if ($count_categories == 0)
                        <p class="text-white ">No categories found!</p>
                    @endif

                    @foreach ($categories as $category)
                        <tr class="hover:bg-gray-200 odd:bg-gray-100 even:bg-gray-300">
                            <td class="user-td">{{ $category->id }} </td>
                            <td class="user-td w-full">{{ $category->name }}</td>
                            <td class="user-td">{{ $category->type }}</td>
                            <td>
                                <div class="flex gap-4 justify-center w-full">
                                    <a href="categories/{{ $category->id }}/edit"><i
                                            class="fa-solid fa-edit hover:text-amber-600 hover:font-bold smooth"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        {{-- items --}}
        <div class="lg:w-6/12 flex flex-col gap-4 pb-20">
            <div class="justify-between flex w-full text-xl font-bold text-gray-300 items-center">
                <p>Items</p>
                <a href="/itmgmt" class="btn-primary"> Add Item</a>
            </div>

            @php
                $count_items = $items->count();
            @endphp
            @if ($count_items == 0)
                <p class="text-white">No items found!</p>
            @endif
            @foreach ($items as $item)
                <x-card class="justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-32 h-32 rounded-lg bg-gray-300 font-bold justify-center items-center flex">
                            @if ($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="item image"
                                    class="w-32 h-32 rounded-lg object-cover">
                            @else
                                <img src="{{ asset('img/logo.png') }}" alt="item image"
                                    class="w-32 h-32 rounded-lg object-contain">
                            @endif
                        </div>
                        <div>
                            <span class="text-gray-500 font-thin text-xs">
                                <i class="fa-regular fa-layer-group"></i>
                                @foreach ($categories as $category)
                                    @if ($item->category == $category['id'])
                                        {{ $category['name'] }}
                                    @endif
                                @endforeach
                            </span>
                            <p>
                                <span class="text-3xl font-thin text-amber-600">{{ $item->name }}</span>
                            </p>
                            <p class="text-lg"><i class="fa-light fa-rupee-sign"></i> {{ $item->price }} /
                                {{ $item->unit }}</p>
                        </div>
                    </div>
                    <div class="flex gap-4 mr-2">
                        <a href="items/{{ $item->id }}/edit"><i
                                class="fa-solid fa-edit hover:text-amber-600 hover:font-bold"></i></a>
                        <form method="POST" action="/items/delete/{{ $item->id }}">
                            @csrf
                            @method('DELETE')
                            <button id="delete"
                                onclick="return confirm('Are you sure you want to delete this record?')"> <i
                                    class="fa-regular fa-trash smooth hover:text-rose-600"></i></button>
                        </form>
                    </div>
                </x-card>
            @endforeach
        </div>
    </div>
</x-layout>

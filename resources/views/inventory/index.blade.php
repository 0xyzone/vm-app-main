<x-layout>
    <div class="grid grid-cols-1 gap-10 h-32 w-full place-items-center">
        <div class="2xl:w-6/12 w-full flex flex-col gap-4">
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
                            <td class="tabledata">
                                <div class="flex gap-4 justify-center w-full">
                                    Action
                                </div>
                            </td>
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
        <div class="2xl:w-6/12 w-full flex flex-col gap-4 pb-20">
            <div class="justify-between flex w-full text-xl font-bold text-gray-300 items-center">
                <p>Items</p>
                <a href="/itmgmt" class="btn-primary"> Add Item</a>
            </div>

            @php
                $count_items = $items->count();
            @endphp
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal w-full">
                        <td class="tabledata"> ID </td>
                        <td class="tabledata"> Image </td>
                        <td class="tabledata"> Name </td>
                        <td class="tabledata"> Price </td>
                        <td class="tabledata"> Unit </td>
                        <td class="tabledata"> Category </td>
                        <td class="tabledata">
                            <div class="flex gap-4 justify-center w-full">
                                Action
                            </div>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @if ($count_items == 0)
                        <p class="text-white">No items found!</p>
                    @endif
                    @foreach ($items as $item)
                        <tr class="hover:bg-gray-200 odd:bg-gray-100 even:bg-gray-300">
                            <td class="user-td">{{ $item['id'] }} </td>
                            <td class="user-td">
                                @if ($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="item image" class="w-10 h-10 object-cover rounded-lg" onerror="this.onerror=null;this.src='{{asset('img/logo.png')}}';">
                                @else
                                <img src="{{ asset('img/logo.png') }}" alt="item image" class="w-10 h-10 object-cover rounded-lg" onerror="this.onerror=null;this.src='{{asset('img/logo.png')}}';">
                                @endif
                            </td>
                            <td class="user-td">{{ $item['name'] }}</td>
                            <td class="user-td">{{ $item['price'] }}</td>
                            <td class="user-td">{{ $item['unit'] }}</td>
                            <td class="user-td">
                                @foreach ($categories as $category)
                                    @if ($item['category'] == $category['id'])
                                        {{ $category['name'] }}
                                    @endif
                                @endforeach
                            </td>
                            <td class="user-td">
                                <div class="flex gap-4 justify-center w-full">
                                    <a href="items/{{ $item->id }}/edit">
                                        <i class="fa-solid fa-edit hover:text-amber-600 hover:font-bold smooth"></i>
                                    </a>
                                    <form method="POST" action="/items/{{$item->id}}/delete">
                                        @csrf
                                        @method('DELETE')
                                        <button class=""  onclick="return confirm('Are you sure you want to delete this item?')">
                                            <i class="fa-regular fa-trash smooth hover:text-rose-600"></i>
                                        </button>
                                    </form></form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>

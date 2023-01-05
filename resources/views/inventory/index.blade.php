<x-layout>
    <div class="grid grid-cols-1 gap-10 h-32 w-full place-items-center">
        <div class="w-full flex flex-col gap-4">
            <div class="justify-between flex w-full text-xl font-bold text-gray-300 items-center">
                {{-- category --}}
                <p>Categories</p>
                <a href="/inventory/category/add" class="btn-primary"> Add Catagory</a>
            </div>

            <table>
                @php
                    $count_categories = $categories->count();
                @endphp
                @if ($count_categories == 0)
                @else
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal w-full font-bold">
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
                                    <a href="inventory/categories/{{ $category->id }}/edit"><i
                                            class="fa-solid fa-edit hover:text-amber-600 hover:font-bold smooth"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="">
                {{ $categories->appends(['items' => $items->currentPage()])->links('') }}
            </div>
        </div>

        {{-- items --}}
        <div class="w-full flex flex-col gap-4 pb-20">
            <div class="justify-between flex w-full text-xl font-bold text-gray-300 items-center">
                <p>Items</p>
                <a href="/inventory/item/add" class="btn-primary"> Add Item</a>
            </div>
            @include('_partials.search')
            <script>
                $('#search').on('keyup', function() {
                    $value = $(this).val();
                    if ($value) {
                        $('#result').show();
                        $('#content').hide();
                    } else {
                        $('#result').hide();
                        $('#content').show();
                    };
                    $.ajax({
                        type: 'get',
                        url: '{{ URL::to('/search/items') }}',
                        data: {
                            'search': $value
                        },

                        success: function(data) {
                            $('#result').html(data);
                        }
                    });
                })
            </script>
            @php
                $count_items = $items->count();
            @endphp
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal w-full font-bold">
                        <td class="tabledata"> ID </td>
                        {{-- <td class="tabledata hidden lg:block"> Image </td> --}}
                        <td class="tabledata"> Name </td>
                        <td class="tabledata"> Price </td>
                        <td class="tabledata hidden lg:block"> Category </td>
                        <td class="tabledata">
                            <div class="flex gap-4 justify-center w-full">
                                Action
                            </div>
                        </td>
                    </tr>
                </thead>
                <tbody id="content">
                    @if ($count_items == 0)
                        <p class="text-white">No items found!</p>
                    @endif
                    @foreach ($items as $item)
                        <tr class="hover:bg-gray-200 odd:bg-gray-100 even:bg-gray-300">
                            <td class="user-td">{{ $item['id'] }} </td>
                            {{-- <td class="user-td hidden lg:inline-block">
                                @if ($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="item image"
                                        class="w-10 h-10 object-cover rounded-lg"
                                        onerror="this.onerror=null;this.src='{{ asset('img/logo.png') }}';">
                                @else
                                    <img src="{{ asset('img/logo.png') }}" alt="item image"
                                        class="w-10 h-10 object-cover rounded-lg"
                                        onerror="this.onerror=null;this.src='{{ asset('img/logo.png') }}';">
                                @endif
                            </td> --}}
                            <td class="user-td">{{ $item['name'] }}</td>
                            <td class="user-td">{{ $item['price'] }}</td>
                            <td class="user-td hidden lg:inline-block">
                                {{$item->categories->name}}
                            </td>
                            <td class="user-td">
                                <div class="flex gap-4 justify-center w-full">
                                    <a href="/inventory/items/{{ $item->id }}/edit">
                                        <i class="fa-solid fa-edit hover:text-amber-600 hover:font-bold smooth"></i>
                                    </a>
                                    <a href="items/{{ $item->id }}/delete" class=""
                                        onclick="return confirm('Are you sure you want to delete this item?')">
                                        <i class="fa-regular fa-trash smooth hover:text-rose-600"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tbody id="result"></tbody>
            </table>
            <div class="mt-6 ">
                {{ $items->appends(['categories' => $categories->currentPage()])->links() }}
            </div>
        </div>
    </div>

</x-layout>

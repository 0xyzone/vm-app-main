<x-layout>
    <div class="mb-6">
        <label for="item" class="text-white">
            Choose items:
        </label>
        {{-- Search Bar --}}
        <input type="search" name="search" class="border border-gray-200 rounded p-2 w-full my-2"
            placeholder="Search Items..." id="search">
        {{-- end search bar --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-2 mt-2" id="content">
        </div>
    </div>
    <x-card class="flex-col !items-start">
        <div class="font-bold text-2xl pb-2 w-full">
            Order # {{ $order_no['id'] }}
        </div>
        <table class="table-auto text-xs w-full">
            <thead class="font-bold">
                <tr class="bg-gray-400 w-full">
                    <td class="w-7/12 pl-2 broder-r-white border-r">Items</td>
                    <td class="w-2/12 broder-r-white border-r text-center">Qty.</td>
                    <td class="w-3/12 text-center">Price</td>
                </tr>
            </thead>
        </table>
    </x-card>
    {{-- Ajax Starting --}}
    <script class="text/javascript">
        $('#search').on('keyup', function() {
            $value = $(this).val();
            if ($value) {
                $('#content').show();
            } else {
                $('#content').hide();
            };
            $.ajax({
                type: 'get',
                url: '{{ URL::to('/search/item') }}',
                data: {
                    'search': $value
                },

                success: function(data) {
                    $('#content').html(data);
                }
            });
        })
    </script>
</x-layout>

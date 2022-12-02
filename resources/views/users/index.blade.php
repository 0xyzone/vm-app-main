<x-layout>
    @include('_partials.search')
    <script>
        $('#search').on('keyup', function() {
            $value = $(this).val();
            if ($value) {
                $('#results').show();
            } else {
                $('#results').hide();
            };
            $.ajax({
                type: 'get',
                url: '{{ URL::to('/search/top/users') }}',
                data: {
                    'search': $value
                },

                success: function(data) {
                    $('#results').html(data);
                }
            });
        })
    </script>
    <div class="justify-between flex w-full text-xl font-bold text-gray-300 items-center">
        <p>Manage User</p>
        <a href="/users/register" class="btn-primary"> Create user </a>
    </div>
    <table class="w-full mt-5 hidden md:inline-block">
        <thead class="w-full">
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal w-full">
                <td class="tabledata">id</td>
                <td class="tabledata w-full">Name</td>
                <td class="tabledata">Username</td>
                <td class="tabledata">Email</td>
                <td class="tabledata">Phone no.</td>
                <td class="tabledata">Role</td>
                <td class="tabledata">Actions</td>
            </tr>
        </thead>
        @php
            $count = $users->count();
        @endphp
        <tbody class="text-gray-600 text-sm font-light">
            @if ($count == 1)
                <tr>
                    <td class="px-6 py-4 text-center" colspan="7">No results found!</td>
                </tr>
            @endif
            @foreach ($users as $user)
                @if ($user['id'] == '1')
                    @continue
                @endif
                <tr class="hover:bg-gray-200 odd:bg-gray-100 even:bg-gray-300">
                    <td class="user-td">{{ $user->id }}</td>
                    <td class="user-td w-full">{{ $user->name }}</td>
                    <td class="user-td">{{ $user->username }}</td>
                    <td class="user-td">{{ $user->email }}</td>
                    <td class="user-td">{{ $user->phone }}</td>
                    <td class="user-td">{{ $user->role }} </td>
                    <td class="user-td">
                        <div class="flex gap-4 justify-center w-full">
                            <a href="users/{{ $user->id }}/edit"><i
                                    class="fa-solid fa-edit hover:text-amber-600 hover:font-bold smooth"></i></a>
                            <form method="POST" action="/users/{{ $user->id }}">
                                @csrf
                                @method('DELETE')
                                <button href='/umgmt' id="delete"
                                    onclick="return confirm('Are you sure you want to delete this record?')"> <i
                                        class="fa-regular fa-trash smooth hover:text-rose-600"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="flex flex-col gap-4 my-4 md:hidden">
        @foreach ($users as $user)
            @if ($user['id'] == '1')
                @continue
            @endif
            <x-card class="justify-between">
                <div class="flex items-center gap-4">
                    <div class="px-6 py-4 text-3xl rounded-lg bg-gray-300 font-bold justify-center items-center flex">
                        {{ $user->id }} </div>
                    <div>
                        <p>
                            <span class="text-3xl font-thin text-amber-600">{{ $user->name }}</span>
                        </p>
                        <span class="text-gray-500 font-thin text-sm">{{ $user->username }}</span>
                        <p class="text-xs"><i class="fa-light fa-envelope"></i> {{ $user->email }}</p>
                        <p class="text-xs"><i class="fa-thin fa-phone-rotary"></i> {{ $user->phone }}</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <a href="users/{{ $user->id }}/edit"><i
                            class="fa-solid fa-edit hover:text-amber-600 hover:font-bold"></i></a>
                    <form method="POST" action="/users/{{ $user->id }}">
                        @csrf
                        @method('DELETE')
                        <button href='/umgmt' id="delete"
                            onclick="return confirm('Are you sure you want to delete this record?')"> <i
                                class="fa-regular fa-trash smooth hover:text-rose-600"></i></button>
                    </form>
                </div>

            </x-card>
        @endforeach
    </div>
    <div class="mt-6">
        {{ $users->links() }}
    </div>
</x-layout>

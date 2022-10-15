<x-layout>

    <div class="justify-between flex w-full text-xl font-bold text-gray-300 items-center">
        <p>Manage User</p>
        <a href="/register" class="border border-gray-300 p-2"> Create user </a>
    </div>
    <table class="w-full mt-5">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <td class="py-3 px-6 text-left">id</td>
                <td class="py-3 px-6 text-left">Name</td>
                <td class="py-3 px-6 text-left">Username</td>
                <td class="py-3 px-6 text-left">Email</td>
                <td class="py-3 px-6 text-left">Phone no.</td>
                <td class="py-3 px-6 text-left">Role</td>
                <td class="py-3 px-6 text-left">Actions</td>
            </tr>
        </thead>
        @php
            $count = $users->count();
        @endphp
            <tbody class="text-gray-600 text-sm font-light">
              @if($count == 1)
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
                    <td class="user-td">{{ $user->name }}</td>
                    <td class="user-td">{{ $user->username }}</td>
                    <td class="user-td">{{ $user->email }}</td>
                    <td class="user-td">{{ $user->phone }}</td>
                    <td class="user-td">{{ $user->role }} </td>
                    <td class="user-td">
                        <div class="flex gap-4">
                            <a href="users/{{ $user->id }}/edit"><i class="fa-solid fa-edit hover:text-amber-600 hover:font-bold"></i></a>
                            <form method="POST" action="/users/{{ $user->id }}">
                                @csrf
                                @method('DELETE')
                                <button href='/umgmt'> <i class="fa-regular fa-trash smooth hover:text-rose-600"></i></button>
                            </form>
                        </div>

                    </td>
                </tr>
        @endforeach
            </tbody>
    </table>
</x-layout>

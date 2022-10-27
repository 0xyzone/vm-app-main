<x-layout>
    <div class="container mx-auto flex flex-col items-center">
        <div class="w-full flex justify-between mb-6">
            <p class="text-2xl font-bold text-white">Customers</p>
            <a href="/customers/add" class="btn-primary">Add Customer</a>
        </div>
        <div class="w-full">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal w-full font-bold">
                        <td class="tabledata">ID</td>
                        <td class="tabledata">Name</td>
                        <td class="tabledata">Email</td>
                        <td class="tabledata">Phone</td>
                        <td class="tabledata flex justify-center">Address</td>
                        <td class="tabledata text-center">Visits(Points)</td>
                        <td class="tabledata flex justify-center">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr class="hover:bg-gray-200 odd:bg-gray-100 even:bg-gray-300">
                            <td class="user-td">{{ $customer->id }}</td>
                            <td class="user-td">{{ $customer->name }}</td>
                            <td class="user-td">{{ $customer->email }}</td>
                            <td class="user-td">{{ $customer->phone }}</td>
                            <td class="user-td flex justify-center">{{ $customer->street }}, {{ $customer->city }}, {{ $customer->country }}
                            </td>
                            <td class="user-td">{{ $customer->visit }}</td>
                            <td class="user-td">
                                <div class="flex gap-4 justify-center w-full">
                                    <a href="/customers/{{ $customer->id }}/edit">
                                        <i class="fa-solid fa-edit hover:text-amber-600 hover:font-bold smooth"></i>
                                    </a>
                                    <form method="POST" action="/customers/{{ $customer->id }}/delete">
                                        @csrf
                                        @method('DELETE')
                                        <button class=""
                                            onclick="return confirm('Are you sure you want to delete this item?')">
                                            <i class="fa-regular fa-trash smooth hover:text-rose-600"></i>
                                        </button>
                                    </form>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <div class="mt-6">
                        {{ $customers->links() }}
                    </div>
                </tbody>
            </table>
        </div>
    </div>
</x-layout>

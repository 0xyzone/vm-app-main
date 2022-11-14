<x-layout>
    <div class="flex justify-between items-center md:mb-6 px-6">
        <p class="text-white font-bold text-2xl">Tables</p>
        <div class="md:flex gap-4 text-white @if (auth()->user()->role == 'Admin') w-4/12 @endif items-center hidden">
            @include('inc.availability')
        </div>
        @if (auth()->user()->role == 'Admin')
            <a href="/tables/add" class="btn-primary text-white">Add Table</a>
        @endif
    </div>
    <div class="w-full flex gap-4 text-white items-center md:hidden justify-center my-3 px-6">
        @include('inc.availability')
    </div>
    @include('_partials.tables')

    <div class="">
        {{ $tables->links('pagination::tailwind') }}
    </div>
</x-layout>

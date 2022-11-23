<x-layout :public="$public">
    <div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-4 gap-4 pb-10 px-6" id="tables">
        @foreach ($tables as $table)
            @php
                if ($table['availability'] == 'Occupied') {
                    $aclass = 'bg-gray-600';
                    $iclassBig = 'fa-duotone fa-lock fa-4x !hidden lg:!inline-block';
                    $iclassSmall = 'fa-duotone fa-lock fa-2x lg:!hidden';
                    $style = '#B71C1C;';
                    $pclass = "text-gray-200";
                    $divclass = "text-gray-500";
                } elseif ($table['availability'] == 'Reserved') {
                    $aclass = 'bg-amber-500 hover:scale-105 hover:bg-gray-500/50';
                    $iclassBig = 'fa-solid fa-book-bookmark fa-4x !hidden lg:!inline-block text-amber-800 group-hover:text-amber-500 smooth';
                    $iclassSmall = 'fa-solid fa-book-bookmark fa-2x lg:!hidden text-amber-800 group-hover:text-amber-500 smooth';
                    $style = '';
                    $pclass = "group-hover:text-gray-200 smooth";
                    $divclass = "text-amber-800 smooth";
                } elseif ($table['availability'] == 'Available') {
                    $aclass = 'hover:text-white hover:scale-105 hover:bg-gray-500/50';
                    $iclassBig = 'fa-duotone fa-lock-open fa-4x !hidden lg:!inline-block';
                    $iclassSmall = 'fa-duotone fa-lock-open fa-3x lg:!hidden';
                    $style = '#4CAF50';
                    $pclass = "";
                    $divclass = "";
                }
            @endphp
            <a href="/tables/{{ $table['id'] }}"
                class="bg-gray-200 rounded-lg flex gap-4 items-center p-4 {{ $aclass }} smooth group">
                <i class="{{$iclassBig}}"
                    style="--fa-primary-color: {{$style}}"></i>
                <i class="{{$iclassSmall}}" style="--fa-primary-color: {{$style}}"></i>
                <div class="flex flex-col h-full w-full justify-center gap-1">
                    <p
                        class="lg:text-4xl font-thin {{$pclass}}">
                        {{ $table['name'] }}</p>
                    <div
                        class="text-xs {{$divclass}} text-gray-400 lg:pl-1.5 group-hover:text-white smooth">
                        Floor:
                        <span class="font-bold">{{ $table['floor'] }}</span>
                        <span class="gap-1 text-xs font-thin inline-flex">
                            <i class="fa-solid fa-loveseat lg:pl-1.5 text-gray-700 group-hover:text-white smooth"></i>
                        </span><span class="font-bold"> {{ $table['seats'] }} </span> seats
                    </div>

                </div>
            </a>
        @endforeach
    </div>
    <script>
        function fetchdata() {
            $.ajax({
                url: '/ajax/public/tables',
                type: 'get',
                success: function(data) {
                    $("#tables").html(data)
                }
            });
        };

        $(document).ready( function(){
            setInterval(fetchdata, 1000);
        })
    </script>
</x-layout>

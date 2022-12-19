<x-layout>
  <div class="grid grid-cols-1 lg:grid-cols-4">
    <x-card>
        Total Orders Today: {{$orders->count()}}
    </x-card>
  </div>
</x-layout>
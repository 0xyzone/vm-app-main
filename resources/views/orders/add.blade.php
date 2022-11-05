<x-layout>
  <div class="px-10 max-w-lg mx-auto pb-10 overflow-y-auto overflow-x-hidden">
  <h2 class="text-2xl font-bold text-white uppercase text-center my-5">
    Add new Order
</h2></div>
<form method="POST" action="/orders/store">
  @csrf
  <div class="mb-6">
    <label for="table" class="text-white">
        Table no.
    </label>
    <select name="table" id="table" class="border border-gray-200 rounded p-2 w-full">
      <option value="" disabled selected hidden>Please Choose an option.</option>
      @foreach ($tables as $table)
          <option value="{{ $table['id'] }}" @if (old('table') === $table['id']) selected @else @endif>
              {{ $table['name'] }}</option>
      @endforeach
  </select>
</div>

<div class="mb-6">
  <label for="customer" class="text-white">
      Choose a customer
  </label>
  <select name="customer" id="customer" class="border border-gray-200 rounded p-2 w-full">
    <option value="" disabled selected hidden>Please Choose an option.</option>
    @foreach ($customers as $customer)
        <option value="{{ $customer['id'] }}" @if (old('customer') === $customer['id']) selected @else @endif>
            {{ $customer['name'] }}</option>
    @endforeach
</select>
</div>

<div class="mb-6">
  <label for="item" class="text-white">
      Choose items
  </label>
  
</div>

<div class="mb-6">
  <button for="add" type="submit"
      class="text-white  border border-sky-200 rounded py-2 px-4 mt-4 hover:bg-black">
      Place Order
  </button>
</div>
</form>
</x-layout>
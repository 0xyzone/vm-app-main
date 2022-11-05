<x-layout>

  <div class="px-10 max-w-lg mx-auto pb-10 overflow-y-auto overflow-x-hidden">
      <h2 class="text-2xl font-bold text-white uppercase text-center my-5">
          Edit User
      </h2>
    
      <form method="POST" action="/users/{{$user->id}}" class="rounded-lg border border-black bg-gray-800 p-10 mb-10 h-full" id="signup">
          @csrf
          @method('PUT')
          <div class="mb-6">
              <label for="name" class="inline-block text-white text-lg mb-2">
                  Name
              </label>
              <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                  value="{{$user->name}}" />
              @error('name')
                  <p class="text-white text-xs mt-1">{{ $message }}</p>
              @enderror
          </div>

          <div class="mb-6">
              <label for="username" class="inline-block text-white text-lg mb-2">
                  Username
              </label>
              <input type="text" class="border border-gray-200 rounded p-2 w-full" name="username"
                  value="{{$user->username}}" />
              @error('username')
                  <p class="text-white text-xs mt-1">{{ $message }}</p>
              @enderror
          </div>

          <div class="mb-6">
              <label for="email" class="inline-block text-white text-lg mb-2">Email</label>
              <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email"
                  value="{{$user->email}}" />
              @error('email')
                  <p class="text-white text-xs mt-1">{{ $message }}</p>
              @enderror
          </div>
          
          <div class="mb-6">
              <label for="phone" class="inline-block text-white text-lg mb-2">
                  Phone No
              </label>
              <input type="number" class="border border-gray-200 rounded p-2 w-full" name="phone"
                  value="{{$user->phone}}" />
              @error('phone')
                  <p class="text-white text-xs mt-1">{{ $message }}</p>
              @enderror
          </div>

          <div class="mb-6">
              <label for="role" class="inline-block text-white text-lg mb-2">
                  Role
              </label>
              <select name="role" id="role" class="border border-gray-200 rounded p-2 w-full">
                  <option value="{{$user->role}}">{{$user->role}}</option>
                  <option value="Admin">Admin</option>
                  <option value="Cashier">Cashier</option>
                  <option value="BarMaster">BarMaster</option>
                  <option value="Waiter">Waiter</option>
                  <option value="KitchenMaster">KitchenMaster</option>
              </select>
              @error('role')
                  <p class="text-white text-xs mt-1">{{ $message }}</p>
              @enderror
          </div>

          <div class="mb-6">
              <button for="edit" type="success"
                  class="text-white  border border-sky-200 rounded py-2 px-4 hover:bg-black">
                  Update
              </button>
          </div>

      </form>

  </div>
</x-layout>

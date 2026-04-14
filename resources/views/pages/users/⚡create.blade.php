<?php
 
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Computed;
use App\Models\User;
 
new class extends Component {
    #[Validate('required|min:3')]
    public string $name = '';

    #[Validate('required|email')]
    public string $email = '';

    #[Validate('required|min:3')]
    public string $password = '';
 
    #[Computed]
    public function users()
    {
        return User::latest()->get();
    }

    public function save()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        $this->reset();

        session()->flash('success', 'User succesfully created.');
    }
};
?>
 
<div class="min-h-full flex flex-row gap-3 px-6 py-12 lg:px-8">
    <div class="flex flex-row md:min-w-1/3 md:flex-col justify-center">
        <div class="sm:w-full sm:max-w-sm">
          <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" class="mx-auto h-10 w-auto" />
          <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Create your account</h2>
        </div>
        @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded bg-green-50 mt-2" role="alert">
            {{ session('success') }}
        </div>
        @endif

        <div class="mt-10 sm:w-full sm:max-w-sm">
          <form wire:submit="save" action="#" method="POST" class="space-y-6">
            <div>
                <label for="name" class="block text-sm/6 font-medium text-gray-900">Name</label>
                <div class="mt-2">
                  <input wire:model="name" id="name" type="name" name="name" required autocomplete="name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                  @error('name')
                  <p class="mt-2.5 text-sm text-red-700">
                    {{ $message }}
                  </p>
                  @enderror
                </div>
              </div>
            <div class="mt-2">
              <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
              <div class="mt-2">
                <input wire:model="email" id="email" type="email" name="email" required autocomplete="email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                @error('email')
                  <p class="mt-2.5 text-sm text-red-700">
                    {{ $message }}
                  </p>
                @enderror
              </div>
            </div>
      
            <div class="mt-2">
                <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                <input wire:model="password" id="password" type="password" name="password" required autocomplete="current-password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                @error('password')
                  <p class="mt-2.5 text-sm text-red-700">
                    {{ $message }}
                  </p>
                @enderror
            </div>
      
            <div class="mt-2">
              <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create User</button>
            </div>
          </form>
      
        </div>
    </div>
    <div>
        <h1>List Users:</h1>
        <ul>
            @foreach($this->users as $data)
            <li>{{ $data->name }}</li>
            @endforeach
        </ul>
    </div>
  </div>
  
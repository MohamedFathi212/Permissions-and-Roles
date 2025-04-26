<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Users / Create
            </h2>
            <a href="{{ route('users.index') }}" class="bg-slate-700 text-sm rounded-md text-white px-5 py-2">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        {{-- Name Field --}}
                        <div class="mb-6">
                            <label for="title" class="block text-lg font-medium mb-2">Name</label>
                            <input placeholder="Enter Name" name="name" id="name" value="{{ old('name') }}"
                                   type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg text-black">
                            @error('name')
                                <p class="text-red-400 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email Field --}}
                        <div class="mb-6">
                            <label for="text" class="block text-lg font-medium mb-2">Email</label>
                            <input placeholder="Enter Email" name="email" id="email" value="{{ old('email') }}"
                                   type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg text-black">
                            @error('email')
                                <p class="text-red-400 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password Field --}}
                        <div class="mb-6">
                            <label for="author" class="block text-lg font-medium mb-2">Password</label>
                            <input placeholder="Enter Password" name="password" id="password" value="{{ old('password') }}"
                                   type="password" class="border-gray-300 shadow-sm w-1/2 rounded-lg text-black">
                            @error('password')
                                <p class="text-red-400 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{--  Confirm Password Field --}}
                        <div class="mb-6">
                            <label for="confirm_password" class="block text-lg font-medium mb-2">Password</label>
                            <input placeholder="Confirm Your Password" name="confirm_password" id="confirm_password" value="{{ old('confirm_password') }}"
                                   type="password" class="border-gray-300 shadow-sm w-1/2 rounded-lg text-black">
                            @error('confirm_password')
                                <p class="text-red-400 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-4 mb-3">
                            @if($roles->isNotEmpty())
                                @foreach($roles as $role)
                                <div class="mt-3">
                                    <input  id="role-{{ $role->id }}" type="checkbox" class="rounded" name="permission[]"
                                    value="{{ $role->name }}">
                                    <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                </div>
                                @endforeach
                            @endif
                        </div>

                        {{-- Submit Button --}}
                        <button class="bg-slate-700 hover:bg-slate-500 text-sm rounded-md text-white px-5 py-3">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

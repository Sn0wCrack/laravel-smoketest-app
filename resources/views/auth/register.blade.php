<x-guest-layout>
    <x-slot name="title">Register</x-slot>

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl font-bold tracking-tight text-gray-900">Create your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('register') }}" method="POST">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                    <div class="mt-2">
                        <input id="name" name="name" type="text" required value="{{ old('name') }}" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset {{ $errors->has('name') ? 'ring-red-500' : 'ring-gray-300' }} placeholder:text-gray-400 focus:ring-2 focus:ring-inset {{ $errors->has('name') ? 'focus:ring-red-500' : 'focus:ring-indigo-600' }} sm:text-sm sm:leading-6">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                    <div class="mt-2">
                        <input id="username" name="username" type="text" required value="{{ old('username') }}" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset {{ $errors->has('username') ? 'ring-red-500' : 'ring-gray-300' }} placeholder:text-gray-400 focus:ring-2 focus:ring-inset {{ $errors->has('username') ? 'focus:ring-red-500' : 'focus:ring-indigo-600' }} sm:text-sm sm:leading-6">
                        @error('username')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" required value="{{ old('email') }}" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset {{ $errors->has('email') ? 'ring-red-500' : 'ring-gray-300' }} placeholder:text-gray-400 focus:ring-2 focus:ring-inset {{ $errors->has('email') ? 'focus:ring-red-500' : 'focus:ring-indigo-600' }} sm:text-sm sm:leading-6">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" required class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset {{ $errors->has('password') ? 'ring-red-500' : 'ring-gray-300' }} placeholder:text-gray-400 focus:ring-2 focus:ring-inset {{ $errors->has('password') ? 'focus:ring-red-500' : 'focus:ring-indigo-600' }} sm:text-sm sm:leading-6">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password</label>
                    <div class="mt-2">
                        <input id="password_confirmation" name="password_confirmation" type="password" required class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset {{ $errors->has('password_confirmation') ? 'ring-red-500' : 'ring-gray-300' }} placeholder:text-gray-400 focus:ring-2 focus:ring-inset {{ $errors->has('password_confirmation') ? 'focus:ring-red-500' : 'focus:ring-indigo-600' }} sm:text-sm sm:leading-6">
                        @error('password_confirmation')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Register</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Already have an account?
                <a href="{{ route('login') }}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Sign in</a>
            </p>
        </div>
    </div>
</x-guest-layout>

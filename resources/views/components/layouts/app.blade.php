<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📝</text>" />
    <title>{{ $title ?? 'Laravel Notes' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gray-50">
    <div class="min-h-full">
        <nav class="bg-white shadow-sm">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 justify-between">
                    <div class="flex">
                        <div class="flex flex-shrink-0 items-center">
                            <a href="{{ route('home') }}" class="text-xl font-bold text-gray-900">Laravel Notes</a>
                        </div>
                        @auth
                            <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                                <a href="{{ route('notes.index') }}" class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">My Notes</a>
                                <a href="{{ route('notes.create') }}" class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">Create Note</a>
                            </div>
                        @endauth
                    </div>
                    <div class="flex items-center">
                        @auth
                            <div class="relative ml-3" x-data="{ open: false }">
                                <div>
                                    <button type="button" @click="open = !open" class="relative flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" id="user-menu-button">
                                        <span class="sr-only">Open user menu</span>
                                        @if(auth()->user()->profile_picture)
                                            <img class="h-8 w-8 rounded-full" src="{{ Storage::url(auth()->user()->profile_picture) }}" alt="">
                                        @else
                                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-indigo-500">
                                                <span class="text-sm font-medium leading-none text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                            </span>
                                        @endif
                                    </button>
                                </div>
                                <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu">
                                    <a href="{{ route('account.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Account Settings</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Sign out</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900">Sign in</a>
                            <a href="{{ route('register') }}" class="ml-4 text-sm font-medium text-indigo-600 hover:text-indigo-500">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="mb-4 rounded-md bg-green-50 p-4">
                        <div class="flex">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('status'))
                    <div class="mb-4 rounded-md bg-blue-50 p-4">
                        <div class="flex">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-blue-800">{{ session('status') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 rounded-md bg-red-50 p-4">
                        <div class="flex">
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                                <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                {{ $slot ?? '' }}
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>

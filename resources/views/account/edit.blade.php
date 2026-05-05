<x-layouts.app>
    <x-slot name="title">Account Settings</x-slot>

    <div class="mx-auto max-w-3xl">
        <div class="space-y-6">
            <div class="bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-base font-semibold leading-6 text-gray-900">Profile Information</h3>
                    <form action="{{ route('account.update') }}" method="POST" enctype="multipart/form-data" class="mt-5 space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Profile Picture</label>
                            <div class="mt-2 flex items-center gap-4">
                                @if(auth()->user()->profile_picture)
                                    <img src="{{ Storage::url(auth()->user()->profile_picture) }}" alt="Profile picture" class="h-16 w-16 rounded-full object-cover">
                                @else
                                    <span class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-indigo-500">
                                        <span class="text-xl font-medium leading-none text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                    </span>
                                @endif
                                <input type="file" name="profile_picture" id="profile_picture" accept="image/jpeg,image/png,image/gif" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">JPG, PNG or GIF. Max 2MB.</p>
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>

                        <div class="border-t border-gray-200 pt-4">
                            <h4 class="text-sm font-medium text-gray-900">Change Password</h4>
                            <p class="mt-1 text-sm text-gray-500">Leave blank if you don't want to change your password.</p>
                        </div>

                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

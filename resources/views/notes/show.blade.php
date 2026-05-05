<x-layouts.app>
    <x-slot name="title">{{ $note->title }}</x-slot>

    <div class="mx-auto max-w-3xl">
        <div class="md:flex md:items-center md:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">{{ $note->title }}</h2>
            </div>
            <div class="mt-4 flex md:ml-4 md:mt-0">
                <a href="{{ route('notes.edit', $note) }}" class="ml-3 inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Edit</a>
                <a href="{{ route('notes.index') }}" class="ml-3 inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Back to Notes</a>
            </div>
        </div>

        <div class="mt-6 bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="prose prose-sm max-w-none">
                    {!! Str::markdown($note->body) !!}
                </div>
            </div>
        </div>

        @if($note->attachments->isNotEmpty())
            <div class="mt-6 bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-base font-semibold leading-6 text-gray-900">Attachments</h3>
                    <ul role="list" class="mt-4 divide-y divide-gray-100 rounded-md border border-gray-200">
                        @foreach($note->attachments as $attachment)
                            <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                                <div class="flex w-0 flex-1 items-center">
                                    <svg class="h-5 w-5 flex-shrink-0 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                    </svg>
                                    <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                        <span class="truncate font-medium">{{ $attachment->file_name }}</span>
                                        <span class="flex-shrink-0 text-gray-400">{{ number_format($attachment->file_size / 1024, 1) }} KB</span>
                                    </div>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <a href="{{ route('notes.attachments.download', $attachment) }}" class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="mt-4 text-sm text-gray-500">
            <p>Created: {{ $note->created_at->format('F j, Y \a\t g:i A') }}</p>
            <p>Updated: {{ $note->updated_at->format('F j, Y \a\t g:i A') }}</p>
        </div>
    </div>
</x-layouts.app>

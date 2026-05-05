<x-layouts.app>
    <x-slot name="title">Edit Note</x-slot>

    <div class="mx-auto max-w-3xl">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-3">
                <div class="mt-5 md:mt-0 md:col-span-3">
                    <form action="{{ route('notes.update', $note) }}" method="POST" enctype="multipart/form-data" x-data="{ markdownPreview: false, body: '{{ addslashes($note->body) }}' }">
                        @csrf
                        @method('PUT')

                        <div class="overflow-hidden shadow sm:rounded-md">
                            <div class="bg-white px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                        <input type="text" name="title" id="title" value="{{ old('title', $note->title) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>

                                    <div class="col-span-6">
                                        <div class="flex items-center justify-between">
                                            <label for="body" class="block text-sm font-medium text-gray-700">Body</label>
                                            <button type="button" @click="markdownPreview = !markdownPreview" class="text-sm text-indigo-600 hover:text-indigo-500" x-text="markdownPreview ? 'Edit' : 'Preview'"></button>
                                        </div>
                                        <div x-show="!markdownPreview" class="mt-1">
                                            <textarea name="body" id="body" x-model="body" rows="12" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('body', $note->body) }}</textarea>
                                        </div>
                                        <div x-show="markdownPreview" class="mt-1 rounded-md border border-gray-300 p-4 bg-gray-50 min-h-[300px] prose prose-sm max-w-none" x-html="renderMarkdown(body)"></div>
                                        <p class="mt-1 text-sm text-gray-500">Markdown formatting is supported.</p>
                                    </div>

                                    <div class="col-span-6">
                                        <label for="attachments" class="block text-sm font-medium text-gray-700">Add Attachments</label>
                                        <div class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                                            <div class="space-y-1 text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <div class="flex text-sm text-gray-600">
                                                    <label for="attachments" class="relative cursor-pointer rounded-md bg-white font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500">
                                                        <span>Upload files</span>
                                                        <input id="attachments" name="attachments[]" type="file" multiple class="sr-only">
                                                    </label>
                                                    <p class="pl-1">or drag and drop</p>
                                                </div>
                                                <p class="text-xs text-gray-500">PNG, JPG, GIF, PDF, DOC, DOCX, XLS, XLSX, TXT, CSV, ZIP up to 10MB</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Update Note</button>
                                <a href="{{ route('notes.show', $note) }}" class="ml-3 inline-flex justify-center rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
        <script>
            function renderMarkdown(text) {
                if (!text) return '<p class="text-gray-400 italic">Nothing to preview</p>';
                return marked.parse(text);
            }
        </script>
    @endpush
</x-layouts.app>

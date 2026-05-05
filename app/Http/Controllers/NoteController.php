<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use App\Models\NoteAttachment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class NoteController extends Controller
{
    public function index(): View
    {
        $notes = auth()->user()->notes()->latest()->paginate(10);

        return view('notes.index', compact('notes'));
    }

    public function create(): View
    {
        return view('notes.create');
    }

    public function store(StoreNoteRequest $request): RedirectResponse
    {
        $note = auth()->user()->notes()->create($request->validated());

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('attachments', 'public');

                NoteAttachment::create([
                    'note_id' => $note->id,
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                ]);
            }
        }

        return redirect()->route('notes.index')->with('success', 'Note created successfully.');
    }

    public function show(Note $note): View
    {
        $this->authorize('view', $note);

        $note->load('attachments');

        return view('notes.show', compact('note'));
    }

    public function edit(Note $note): View
    {
        $this->authorize('update', $note);

        return view('notes.edit', compact('note'));
    }

    public function update(UpdateNoteRequest $request, Note $note): RedirectResponse
    {
        $this->authorize('update', $note);

        $note->update($request->validated());

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('attachments', 'public');

                NoteAttachment::create([
                    'note_id' => $note->id,
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                ]);
            }
        }

        return redirect()->route('notes.index')->with('success', 'Note updated successfully.');
    }

    public function destroy(Note $note): RedirectResponse
    {
        $this->authorize('delete', $note);

        foreach ($note->attachments as $attachment) {
            Storage::disk('public')->delete($attachment->file_path);
        }

        $note->delete();

        return redirect()->route('notes.index')->with('success', 'Note deleted successfully.');
    }

    public function downloadAttachment(NoteAttachment $attachment): StreamedResponse
    {
        $this->authorize('view', $attachment->note);

        return Storage::disk('public')->download($attachment->file_path, $attachment->file_name);
    }
}

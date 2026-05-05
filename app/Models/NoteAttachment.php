<?php

namespace App\Models;

use Database\Factories\NoteAttachmentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

#[Fillable(['note_id', 'file_path', 'file_name', 'mime_type', 'file_size'])]
class NoteAttachment extends Model
{
    /** @use HasFactory<NoteAttachmentFactory> */
    use HasFactory;

    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class);
    }

    public function url(): string
    {
        return Storage::url($this->file_path);
    }
}

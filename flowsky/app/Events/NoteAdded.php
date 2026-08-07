<?php

namespace App\Events;

use App\Models\Note;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NoteAdded
{
    use Dispatchable, SerializesModels;

    public function __construct(public Note $note)
    {
    }
}
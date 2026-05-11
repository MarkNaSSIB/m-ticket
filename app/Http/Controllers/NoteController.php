<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Store a newly created note.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'description' => 'required|string|max:1000',
        ]);

        $note = new Note($validated);
        $note->save();

        return back();
    }

    /**
     * Remove the specified note.
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return back();
    }
}

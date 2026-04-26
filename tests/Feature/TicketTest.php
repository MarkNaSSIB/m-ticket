<?php

use App\Models\Note;
use App\Models\Ticket;
use App\Models\User;

test('belongs to a user', function () {
    $ticket = Ticket::factory()->create();

    expect($ticket->user)->toBeInstanceOf(User::class);
});

test('can have notes', function () {

    $ticket = Ticket::factory()->create();

    // expect($ticket->notes)->toHaveCount(0);

    // Create a note associated with the ticket
    $note = Note::factory()->for($ticket)->create();

    expect($note->ticket)->toBeInstanceOf(Ticket::class);

    // check if ticket has note and if the note is the one we created
    expect($ticket->notes)->toHaveCount(1);
    expect($ticket->notes->first()->id)->toBe($note->id);

});

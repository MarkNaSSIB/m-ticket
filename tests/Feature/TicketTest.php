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

    expect($ticket->note)->toBeEmpty();

    // Create a note associated with the ticket
    //$note = Note::factory()->create();

    //expect($ticket->notes)->toContain($note);
    //implement later

});

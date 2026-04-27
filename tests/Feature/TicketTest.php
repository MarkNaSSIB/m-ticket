<?php

use App\Models\Note;
use App\Models\Ticket;
use App\Models\User;
use App\TicketPrio;
use App\TicketStatus;
use App\TicketPriority;
use Illuminate\Support\Facades\Schema;
use \Illuminate\Database\Eloquent\Casts\ArrayObject;

//
// ─────────────────────────────────────────────────────────────
//   BASIC MODEL STRUCTURE
// ─────────────────────────────────────────────────────────────
//

test('tickets table has expected columns', function () {
    expect(Schema::hasColumns('tickets', [
        'id',
        'user_id',
        'title',
        'description',
        'status',
        'priority',
        'links',
        'image_path',
        'created_at',
        'updated_at',
    ]))->toBeTrue();
});

//
// ─────────────────────────────────────────────────────────────
//   RELATIONSHIPS
// ─────────────────────────────────────────────────────────────
//

test('ticket belongs to a user', function () {
    $ticket = Ticket::factory()->create();

    expect($ticket->user)->toBeInstanceOf(User::class);
    expect($ticket->user_id)->toBe($ticket->user->id);
});

test('ticket can have many notes', function () {
    $ticket = Ticket::factory()->create();

    $noteA = Note::factory()->for($ticket)->create();
    $noteB = Note::factory()->for($ticket)->create();

    expect($ticket->notes)->toHaveCount(2);
    expect($ticket->notes->pluck('id')->all())->toContain($noteA->id, $noteB->id);
});

test('note belongs to a ticket', function () {
    $ticket = Ticket::factory()->create();
    $note = Note::factory()->for($ticket)->create();

    expect($note->ticket)->toBeInstanceOf(Ticket::class);
    expect($note->ticket_id)->toBe($ticket->id);
});

//
// ─────────────────────────────────────────────────────────────
//   DEFAULTS & CASTS
// ─────────────────────────────────────────────────────────────
//

test('ticket defaults to OPEN status and MEDIUM priority', function () {
    $ticket = Ticket::factory()->create();

    expect($ticket->status)->toBe(TicketStatus::OPEN);
    expect($ticket->priority)->toBe(TicketPrio::MEDIUM);
});

test('ticket casts status and priority to enums', function () {
    $ticket = Ticket::factory()->create([
        'status' => TicketStatus::INPROGRESS,
        'priority' => TicketPrio::HIGH,
    ]);

    expect($ticket->status)->toBeInstanceOf(TicketStatus::class);
    expect($ticket->priority)->toBeInstanceOf(TicketPrio::class);
});

test('ticket links attribute is always an array', function () {
    $ticket = Ticket::factory()->create(['links' => ['https://example.com']]);

    expect($ticket->links)->toBeInstanceOf(ArrayObject::class);

    expect($ticket->links)->toContain('https://example.com');
});

//
// ─────────────────────────────────────────────────────────────
//   MASS ASSIGNMENT & FACTORY
// ─────────────────────────────────────────────────────────────
//

test('ticket factory creates a valid ticket', function () {
    $ticket = Ticket::factory()->create();

    expect($ticket->id)->not->toBeNull();
    expect($ticket->title)->not->toBeEmpty();
    expect($ticket->user)->toBeInstanceOf(User::class);
});

test('ticket can be mass assigned safely', function () {
    $data = Ticket::factory()->make()->toArray();

    $ticket = Ticket::create($data);

    expect($ticket->exists)->toBeTrue();
    expect($ticket->title)->toBe($data['title']);
});

//
// ─────────────────────────────────────────────────────────────
//   IMAGE HANDLING
// ─────────────────────────────────────────────────────────────
//

test('ticket image_path is optional', function () {
    $ticket = Ticket::factory()->create(['image_path' => null]);

    expect($ticket->image_path)->toBeNull();
});

//
// ─────────────────────────────────────────────────────────────
//   TIMESTAMPS
// ─────────────────────────────────────────────────────────────
//

test('ticket has timestamps', function () {
    $ticket = Ticket::factory()->create();

    expect($ticket->created_at)->not->toBeNull();
    expect($ticket->updated_at)->not->toBeNull();
});

//
// ─────────────────────────────────────────────────────────────
//   USER OWNERSHIP RULES (if applicable)
// ─────────────────────────────────────────────────────────────
//

test('ticket belongs to the user who created it', function () {
    $user = User::factory()->create();

    $ticket = Ticket::factory()->for($user)->create();

    expect($ticket->user_id)->toBe($user->id);
});

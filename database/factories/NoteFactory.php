<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ticket_id'   => Ticket::factory(), 
            'description' => fake()->paragraph(),
        ];
    }
}

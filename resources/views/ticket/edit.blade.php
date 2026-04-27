<x-layout>

    <header class="py-8 md:py-12">
        <h1 class="text-3xl font-bold">Edit Ticket</h1>
        <p class="text-muted-foreground mt-2">…or at least that’s what you *thought*.</p>
    </header>

    <x-card class="max-w-xl text-center py-12">

        <h2 class="text-2xl font-semibold mb-4">
            Nice try.
        </h2>

        <p class="text-muted-foreground mb-6">
            Tickets can’t be edited — they live with their choices.  
            Try adding a note instead.
        </p>

        <a 
            href="{{ route('ticket.show', $ticket) }}"
            class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
        >
            Back to Ticket
        </a>

    </x-card>

</x-layout>
